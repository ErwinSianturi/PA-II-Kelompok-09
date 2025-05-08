import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

class TambahPendidikanPage extends StatefulWidget {
  const TambahPendidikanPage({super.key});

  @override
  State<TambahPendidikanPage> createState() => _TambahPendidikanPageState();
}

class _TambahPendidikanPageState extends State<TambahPendidikanPage> {
  final _formKey = GlobalKey<FormState>();

  String? selectedJenjang;
  final TextEditingController institusiController = TextEditingController();
  final TextEditingController jurusanController = TextEditingController();

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
    if (_formKey.currentState!.validate()) {
      final response = await http.post(
        Uri.parse('http://localhost:8080/education'), // API URL
        headers: {'Content-Type': 'application/json'},
        body: json.encode({
          'level': selectedJenjang,
          'institution': institusiController.text,
          'major': jurusanController.text,
        }),
      );

      if (response.statusCode == 200) {
        // Success, do something
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Data berhasil disimpan!')),
        );
      } else {
        // Failure, show error
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Gagal menyimpan data')),
        );
      }
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
                ),
                const SizedBox(height: 16),

                TextFormField(
                  controller: institusiController,
                  decoration: inputDecoration.copyWith(labelText: 'Nama Institusi'),
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
                        onPressed: () => Navigator.pop(context),
                        style: OutlinedButton.styleFrom(
                          side: const BorderSide(color: Colors.purple),
                        ),
                        child: const Text('Batal', style: TextStyle(color: Colors.purple)),
                      ),
                    ),
                    const SizedBox(width: 10),
                    Expanded(
                      child: ElevatedButton(
                        onPressed: saveData,  // Call saveData function
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color(0xFF9E61EB),
                        ),
                        child: const Text('Simpan', style: TextStyle(color: Colors.white)),
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
}
