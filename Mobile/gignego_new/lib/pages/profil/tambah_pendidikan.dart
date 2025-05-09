import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

class TambahPendidikanPage extends StatefulWidget {
  final int userId; // Tambahkan parameter userId

  const TambahPendidikanPage({
    Key? key, 
    required this.userId, // Wajib menerima userId
  }) : super(key: key);

  @override
  State<TambahPendidikanPage> createState() => _TambahPendidikanPageState();
}

class _TambahPendidikanPageState extends State<TambahPendidikanPage> {
  final _formKey = GlobalKey<FormState>();

  String? selectedJenjang;
  final TextEditingController institusiController = TextEditingController();
  final TextEditingController jurusanController = TextEditingController();
  bool _isLoading = false;

  final List<String> jenjangPendidikan = [
    'TK',
    'SD',
    'SMP',
    'SMA',
    'D1',
    'D2',
    'D3',
    'D4/S1',
    'S2',
    'S3',
    'Lainnya'
  ];

  // Function to send data to the server
  Future<void> saveData() async {
    // Validasi form
    if (!_formKey.currentState!.validate()) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Mohon lengkapi form dengan benar')),
      );
      return;
    }

    // Validasi jenjang pendidikan
    if (selectedJenjang == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Mohon pilih jenjang pendidikan')),
      );
      return;
    }

    setState(() {
      _isLoading = true;
    });

    try {
      final response = await http.post(
        Uri.parse('http://10.0.2.2:8080/education'), // Gunakan 10.0.2.2 untuk emulator Android
        headers: {'Content-Type': 'application/json'},
        body: json.encode({
          'user_id': widget.userId, // Tambahkan user_id
          'level': selectedJenjang,
          'institution': institusiController.text,
          'major': jurusanController.text.isEmpty ? '-' : jurusanController.text,
        }),
      );

      setState(() {
        _isLoading = false;
      });

      if (response.statusCode == 200 || response.statusCode == 201) {
        // Success, do something
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Data pendidikan berhasil disimpan!')),
        );
        Navigator.pop(context, true); // Kembali dengan hasil sukses
      } else {
        // Failure, show error
        final errorData = json.decode(response.body);
        final errorMessage = errorData['error'] ?? 'Gagal menyimpan data';
        
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Error: $errorMessage')),
        );
      }
    } catch (e) {
      setState(() {
        _isLoading = false;
      });
      
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Terjadi kesalahan: $e')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    final inputDecoration = InputDecoration(
      filled: true,
      fillColor: Colors.grey[100],
      border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
      contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
    );

    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.black),
          onPressed: () => Navigator.pop(context),
        ),
        title: const Text(
          'Tambah Pendidikan',
          style: TextStyle(color: Colors.purple, fontWeight: FontWeight.bold),
        ),
        centerTitle: true,
      ),
      body: Padding(
        padding: const EdgeInsets.all(20.0),
        child: Form(
          key: _formKey,
          child: SingleChildScrollView(
            child: Column(
              children: [
                DropdownButtonFormField<String>(
                  value: selectedJenjang,
                  items: jenjangPendidikan.map((jenjang) {
                    return DropdownMenuItem(
                      value: jenjang,
                      child: Text(jenjang),
                    );
                  }).toList(),
                  onChanged: (value) {
                    setState(() {
                      selectedJenjang = value;
                    });
                  },
                  decoration: inputDecoration.copyWith(labelText: 'Jenjang Pendidikan'),
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Jenjang pendidikan wajib dipilih';
                    }
                    return null;
                  },
                ),
                const SizedBox(height: 16),

                TextFormField(
                  controller: institusiController,
                  decoration: inputDecoration.copyWith(labelText: 'Nama Institusi'),
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Nama institusi wajib diisi';
                    }
                    return null;
                  },
                ),
                const SizedBox(height: 16),

                TextFormField(
                  controller: jurusanController,
                  decoration: inputDecoration.copyWith(labelText: 'Jurusan (opsional)'),
                ),
                const SizedBox(height: 24),

                Row(
                  children: [
                    Expanded(
                      child: OutlinedButton(
                        onPressed: _isLoading ? null : () => Navigator.pop(context),
                        style: OutlinedButton.styleFrom(
                          side: const BorderSide(color: Colors.purple),
                        ),
                        child: const Text('Batal', style: TextStyle(color: Colors.purple)),
                      ),
                    ),
                    const SizedBox(width: 10),
                    Expanded(
                      child: ElevatedButton(
                        onPressed: _isLoading ? null : saveData,
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color(0xFF9E61EB),
                        ),
                        child: _isLoading
                            ? const SizedBox(
                                width: 20,
                                height: 20,
                                child: CircularProgressIndicator(
                                  color: Colors.white,
                                  strokeWidth: 2,
                                ),
                              )
                            : const Text('Simpan', style: TextStyle(color: Colors.white)),
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  @override
  void dispose() {
    institusiController.dispose();
    jurusanController.dispose();
    super.dispose();
  }
}
