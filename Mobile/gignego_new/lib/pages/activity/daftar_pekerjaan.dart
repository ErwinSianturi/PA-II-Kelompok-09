import 'package:flutter/material.dart';
import 'package:flutter_application/pages/activity/lihat_aktivitas.dart';
import 'package:image_picker/image_picker.dart';
import 'dart:io';

class EditPekerjaanPage extends StatefulWidget {
  const EditPekerjaanPage({super.key});

  @override
  State<EditPekerjaanPage> createState() => _FormPekerjaanPageState();
}

class _FormPekerjaanPageState extends State<EditPekerjaanPage> {
  final _formKey = GlobalKey<FormState>();

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

  File? _gambarPekerjaan;

  Future<void> _pilihGambar() async {
    final pickedImage = await ImagePicker().pickImage(source: ImageSource.gallery);
    if (pickedImage != null) {
      setState(() {
        _gambarPekerjaan = File(pickedImage.path);
      });
    }
  }

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
              Text(
                "Gambar Pekerjaan",
                style: TextStyle(fontWeight: FontWeight.w600, fontSize: 16),
              ),
              const SizedBox(height: 8),
              _gambarPekerjaan != null
                  ? ClipRRect(
                      borderRadius: BorderRadius.circular(12),
                      child: Image.file(
                        _gambarPekerjaan!,
                        height: 160,
                        width: double.infinity,
                        fit: BoxFit.cover,
                      ),
                    )
                  : Container(
                      height: 160,
                      width: double.infinity,
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(12),
                        border: Border.all(color: Colors.grey),
                      ),
                      child: const Center(child: Text("Belum ada gambar")),
                    ),
              const SizedBox(height: 8),
              ElevatedButton.icon(
                onPressed: _pilihGambar,
                icon: const Icon(Icons.photo),
                label: const Text("Pilih Gambar"),
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.deepPurple,
                  foregroundColor: Colors.white,
                ),
              ),

              const SizedBox(height: 24),
              ElevatedButton(
                onPressed: () {
                  if (_formKey.currentState!.validate()) {
                    ScaffoldMessenger.of(context).showSnackBar(
                      const SnackBar(content: Text('Data berhasil disimpan')),
                    );

                    // Navigasi ke HalamanBaru setelah data disimpan
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => LihatAktivitasPage()),
                    );
                  }
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF8A2BE2),
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
