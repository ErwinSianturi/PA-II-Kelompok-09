import 'package:flutter/material.dart';

class EditPekerjaanPage extends StatefulWidget {
  const EditPekerjaanPage({super.key});

  @override
  State<EditPekerjaanPage> createState() => _FormPekerjaanPageState();
}

class _FormPekerjaanPageState extends State<EditPekerjaanPage> {
  final _formKey = GlobalKey<FormState>();

  // Controllers
  final TextEditingController _namaController = TextEditingController();
  final TextEditingController _hargaController = TextEditingController();
  final TextEditingController _deskripsiController = TextEditingController();
  final TextEditingController _syaratController = TextEditingController();
  final TextEditingController _lingkupController = TextEditingController();
  final TextEditingController _lamaController = TextEditingController();

  String? _jenisPekerjaan;
  final List<String> _jenisPekerjaanList = [
    'Kebersihan Pekarangan',
    'Mencuci Kendaraan',
    'Kebersihan Rumah',
    'Sofa Cleaning',
    'Perbaikan Rumah'
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Edit Form Pekerjaan'),
        backgroundColor: const Color.fromARGB(255, 170, 56, 236),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: Form(
          key: _formKey,
          child: ListView(
            children: [
              _buildTextField("Nama Pekerjaan", _namaController),
              _buildTextField(
                "Harga Pekerjaan",
                _hargaController,
                keyboardType: TextInputType.number,
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Harga wajib diisi';
                  }
                  final number = num.tryParse(value);
                  if (number == null || number <= 0) {
                    return 'Harga harus berupa angka positif';
                  }
                  return null;
                },
              ),
              _buildTextField("Deskripsi", _deskripsiController, maxLines: 3),
              _buildTextField("Syarat dan Ketentuan", _syaratController, maxLines: 3),
              _buildTextField("Lingkup Kerja", _lingkupController, maxLines: 2),

              const SizedBox(height: 10),
              DropdownButtonFormField<String>(
                decoration: const InputDecoration(
                  labelText: "Jenis Pekerjaan",
                  border: OutlineInputBorder(),
                ),
                value: _jenisPekerjaan,
                items: _jenisPekerjaanList.map((jenis) {
                  return DropdownMenuItem(value: jenis, child: Text(jenis));
                }).toList(),
                onChanged: (value) {
                  setState(() {
                    _jenisPekerjaan = value;
                  });
                },
                validator: (value) => value == null ? 'Pilih jenis pekerjaan' : null,
              ),

              const SizedBox(height: 16),
              _buildTextField("Lama Pekerjaan (jam)", _lamaController, keyboardType: TextInputType.number),

              const SizedBox(height: 24),
              ElevatedButton(
                onPressed: () {
                  if (_formKey.currentState!.validate()) {
                    ScaffoldMessenger.of(context).showSnackBar(
                      const SnackBar(content: Text('Data berhasil disimpan')),
                    );
                  }
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF8A2BE2), // Ungu terang
                  padding: const EdgeInsets.symmetric(vertical: 16),
                  foregroundColor: Colors.white,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                ),
                child: const Text(
                  'Simpan',
                  style: TextStyle(
                    fontSize: 18,
                    color: Colors.white,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildTextField(
    String label,
    TextEditingController controller, {
    int maxLines = 1,
    TextInputType? keyboardType,
    String? Function(String?)? validator,
  }) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 16),
      child: TextFormField(
        controller: controller,
        keyboardType: keyboardType,
        maxLines: maxLines,
        decoration: InputDecoration(
          labelText: label,
          border: const OutlineInputBorder(),
        ),
        validator: validator ?? (value) => (value == null || value.isEmpty) ? 'Wajib diisi' : null,
      ),
    );
  }
}
