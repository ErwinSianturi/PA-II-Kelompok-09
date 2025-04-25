import 'dart:io';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:flutter_application/pages/activity/lihat_aktivitas.dart'; // Ensure this is imported

class TambahPekerjaanPage extends StatefulWidget {
  const TambahPekerjaanPage({Key? key}) : super(key: key);

  @override
  State<TambahPekerjaanPage> createState() => _TambahPekerjaanPageState();
}

class _TambahPekerjaanPageState extends State<TambahPekerjaanPage> {
  final _formKey = GlobalKey<FormState>();
  final picker = ImagePicker();

  String? _namaPekerjaan;
  String? _harga;
  String? _deskripsi;
  String? _syarat;
  String? _lingkup;
  String? _jenis = "Kebersihan";
  String? _lamaJam;
  DateTime? _selectedDate;
  TimeOfDay? _selectedTime;

  List<File?> _images = [null, null, null];

  Future<void> _pickImage(int index) async {
    final pickedFile = await picker.pickImage(source: ImageSource.gallery);
    if (pickedFile != null) {
      setState(() {
        _images[index] = File(pickedFile.path);
      });
    }
  }

  Future<void> _pickDateTime() async {
    final date = await showDatePicker(
      context: context,
      initialDate: _selectedDate ?? DateTime.now(),
      firstDate: DateTime(2020),
      lastDate: DateTime(2100),
    );
    if (date != null) {
      final time = await showTimePicker(
        context: context,
        initialTime: _selectedTime ?? TimeOfDay.now(),
      );
      if (time != null) {
        setState(() {
          _selectedDate = date;
          _selectedTime = time;
        });
      }
    }
  }

  String get formattedDateTime {
    if (_selectedDate == null || _selectedTime == null) return 'mm/dd/yyyy --:-- --';
    final date = "${_selectedDate!.month}/${_selectedDate!.day}/${_selectedDate!.year}";
    final time = _selectedTime!.format(context);
    return "$date $time";
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Tambah Pekerjaan"),
        backgroundColor: Color(0xFF9E61EB),
      ),
      body: SingleChildScrollView(
        padding: EdgeInsets.all(16),
        child: Form(
          key: _formKey,
          child: Column(
            children: [
              buildTextField("Nama Pekerjaan", (val) => _namaPekerjaan = val),
              buildTextField("Harga Pekerjaan", (val) => _harga = val, keyboardType: TextInputType.number),
              buildTextField("Deskripsi", (val) => _deskripsi = val, maxLines: 3),
              buildTextField("Syarat dan Ketentuan", (val) => _syarat = val, maxLines: 3),
              buildTextField("Lingkup Kerja", (val) => _lingkup = val, maxLines: 3),
              SizedBox(height: 12),
              buildDropdownJenisPekerjaan(),
              buildTextField("Lama Pekerjaan (Jam)", (val) => _lamaJam = val, keyboardType: TextInputType.number),
              SizedBox(height: 12),
              Row(
                children: [
                  Expanded(
                    child: Text("Date and Time: $formattedDateTime"),
                  ),
                  ElevatedButton(
                    onPressed: _pickDateTime,
                    child: Text("Pilih"),
                  ),
                ],
              ),
              SizedBox(height: 16),
              ...List.generate(3, (index) => buildImagePicker(index)),
              SizedBox(height: 24),
              ElevatedButton(
                onPressed: () {
                  if (_formKey.currentState!.validate()) {
                    _formKey.currentState!.save();

                    // Show success message
                    ScaffoldMessenger.of(context).showSnackBar(
                      SnackBar(content: Text("Pekerjaan berhasil ditambahkan")),
                    );

                    Navigator.pushReplacement(
                      context,
                      MaterialPageRoute(builder: (context) => LihatAktivitasPage()),
                    );
                  }
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Color(0xFF9E61EB),
                  foregroundColor: Colors.white, // <-- text color
                  padding: EdgeInsets.symmetric(horizontal: 40, vertical: 16),
                ),
                child: Text("Simpan", style: TextStyle(fontSize: 16)),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget buildTextField(String label, Function(String) onSaved,
      {TextInputType keyboardType = TextInputType.text, int maxLines = 1}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8),
      child: TextFormField(
        keyboardType: keyboardType,
        maxLines: maxLines,
        decoration: InputDecoration(
          labelText: label,
          border: OutlineInputBorder(),
        ),
        validator: (val) => val == null || val.isEmpty ? 'Wajib diisi' : null,
        onSaved: (val) => onSaved(val!),
      ),
    );
  }

  Widget buildDropdownJenisPekerjaan() {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8),
      child: DropdownButtonFormField<String>(
        value: _jenis,
        decoration: InputDecoration(
          labelText: "Jenis Pekerjaan",
          border: OutlineInputBorder(),
        ),
        items: ["Kebersihan", "Perbaikan Rumah", "Tutor", "Lainnya"]
            .map((item) => DropdownMenuItem(value: item, child: Text(item)))
            .toList(),
        onChanged: (value) => setState(() => _jenis = value),
      ),
    );
  }

  Widget buildImagePicker(int index) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text("Gambar ${index + 1}"),
          SizedBox(height: 6),
          Row(
            children: [
              ElevatedButton(
                onPressed: () => _pickImage(index),
                child: Text("Pilih Gambar"),
              ),
              SizedBox(width: 12),
              _images[index] != null
                  ? Image.file(_images[index]!, width: 80, height: 80, fit: BoxFit.cover)
                  : Text("No file chosen"),
            ],
          ),
        ],
      ),
    );
  }
}
