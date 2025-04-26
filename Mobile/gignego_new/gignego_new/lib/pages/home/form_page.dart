import 'dart:io';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:intl/intl.dart';
import 'package:flutter_application/pages/home/models/job.dart';
import 'validasi.dart';
import 'package:flutter/services.dart';


class FormPage extends StatefulWidget {
  final Function(Job) onJobAdded; // Tambahkan parameter untuk callback

  const FormPage({Key? key, required this.onJobAdded}) : super(key: key);

  @override
  _FormPageState createState() => _FormPageState();
}

class _FormPageState extends State<FormPage> {
  final TextEditingController _judulController = TextEditingController();
  final TextEditingController _deskripsiController = TextEditingController();
  final TextEditingController _lokasiController = TextEditingController();
  final TextEditingController _waktuController = TextEditingController();
  final TextEditingController _tanggalController = TextEditingController();
  final TextEditingController _hargaController = TextEditingController();
  final TextEditingController _masaIklanController = TextEditingController();
  File? _selectedImage;
  String? _selectedKategori;

  final picker = ImagePicker();
  final _formKey = GlobalKey<FormState>(); // Tambahkan untuk validasi

  Future<void> _pickDate(TextEditingController controller) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(2000),
      lastDate: DateTime(2101),
    );
    if (picked != null) {
      controller.text = DateFormat('yyyy-MM-dd').format(picked);
    }
  }

  Future<void> _pickTime(TextEditingController controller) async {
    final TimeOfDay? picked = await showTimePicker(
      context: context,
      initialTime: TimeOfDay.now(),
    );
    if (picked != null) {
      controller.text = picked.format(context);
    }
  }

  Future<void> _pickImage() async {
    final pickedFile = await picker.pickImage(source: ImageSource.gallery);
    if (pickedFile != null) {
      setState(() {
        _selectedImage = File(pickedFile.path);
      });
    }
  }

  void _submitForm() {
    if (_formKey.currentState!.validate() && _selectedImage != null && _selectedKategori != null) {
      final jobBaru = Job(
        judul: _judulController.text,
        deskripsi: _deskripsiController.text,
        lokasi: _lokasiController.text,
        waktu: _waktuController.text,
        tanggal: _tanggalController.text,
        harga: _hargaController.text,
        masaIklan: _masaIklanController.text,
        kategori: _selectedKategori!,
        gambar: _selectedImage!.path,
        status: 'Tersedia',
      );

      Navigator.push(
        context,
        MaterialPageRoute(
          builder: (context) => ValidasiPage(
            job: jobBaru,
            onJobAdded: widget.onJobAdded,
          ),
        ),
      );
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text(
            _selectedImage == null
                ? "Gambar wajib dipilih!"
                : _selectedKategori == null
                    ? "Kategori wajib dipilih!"
                    : "Semua field wajib diisi!",
          ),
        ),
      );
    }
  }

  @override
  void dispose() {
    _judulController.dispose();
    _deskripsiController.dispose();
    _lokasiController.dispose();
    _waktuController.dispose();
    _tanggalController.dispose();
    _hargaController.dispose();
    _masaIklanController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        leading: IconButton(
          icon: Icon(Icons.arrow_back, color: Colors.black),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
        backgroundColor: Colors.white,
        elevation: 0,
        centerTitle: true,
        title: Text(
          "Butuh bantuan apa hari ini?",
          style: TextStyle(color: Colors.black, fontWeight: FontWeight.bold),
        ),
      ),
      body: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 20),
        child: SingleChildScrollView(
          child: Form(
            key: _formKey,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                _buildTextField("Judul Iklan", _judulController),
                _buildTextField("Deskripsi", _deskripsiController),
                _buildDropdownField("Pilih kategori"),
                _buildTextField("Lokasi", _lokasiController),
                _buildDateTimeField(
                    "Waktu pengerjaan", _waktuController, Icons.access_time,
                    isTime: true),
                _buildDateTimeField(
                    "Tanggal pengerjaan", _tanggalController, Icons.calendar_today),
                _buildTextField("Harga", _hargaController, isNumber: true),
                _buildDateTimeField(
                    "Masa Iklan", _masaIklanController, Icons.calendar_today),
                _buildImageUploadSection(),
                SizedBox(height: 20),
                _buildSubmitButton(),
                SizedBox(height: 40),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildTextField(String label, TextEditingController controller, {bool isNumber = false}) {
  return Padding(
    padding: const EdgeInsets.symmetric(vertical: 8),
    child: Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(label, style: TextStyle(fontWeight: FontWeight.bold)),
        SizedBox(height: 5),
        TextFormField(
          controller: controller,
          decoration: InputDecoration(
            border: OutlineInputBorder(),
          ),
          keyboardType: isNumber ? TextInputType.number : TextInputType.text,
          inputFormatters: isNumber ? [FilteringTextInputFormatter.digitsOnly] : [],
          validator: (value) {
            if (value == null || value.isEmpty) {
              return '$label wajib diisi';
            }
            if (isNumber && int.tryParse(value) == null) {
              return '$label harus berupa angka';
            }
            return null;
          },
        ),
      ],
    ),
  );
}


  Widget _buildDropdownField(String label) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(label, style: TextStyle(fontWeight: FontWeight.bold)),
          SizedBox(height: 5),
          DropdownButtonFormField<String>(
            decoration: InputDecoration(
              border: OutlineInputBorder(),
            ),
            value: _selectedKategori,
            hint: Text("Pilih kategori"),
            items: [
              "Kebersihan",
              "Perbaikan Rumah",
              "Perbaikan Kendaraan",
              "Perbaikan Elektronik",
              "Tutor",
              "Rumah Tangga",
              "Fotografi dan Videografi",
              "Lainnya"
            ]
                .map((String category) =>
                    DropdownMenuItem(value: category, child: Text(category)))
                .toList(),
            onChanged: (value) {
              setState(() {
                _selectedKategori = value;
              });
            },
            validator: (value) =>
                value == null ? 'Kategori wajib dipilih' : null,
          ),
        ],
      ),
    );
  }

  Widget _buildDateTimeField(String label, TextEditingController controller,
      IconData icon, {bool isTime = false}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(label, style: TextStyle(fontWeight: FontWeight.bold)),
          SizedBox(height: 5),
          TextFormField(
            controller: controller,
            readOnly: true,
            decoration: InputDecoration(
              border: OutlineInputBorder(),
              suffixIcon: Icon(icon),
            ),
            onTap: () {
              if (isTime) {
                _pickTime(controller);
              } else {
                _pickDate(controller);
              }
            },
            validator: (value) =>
                value == null || value.isEmpty ? '$label wajib diisi' : null,
          ),
        ],
      ),
    );
  }

  Widget _buildImageUploadSection() {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text("Gambar", style: TextStyle(fontWeight: FontWeight.bold)),
          SizedBox(height: 5),
          GestureDetector(
            onTap: _pickImage,
            child: Container(
              height: 120,
              width: double.infinity,
              decoration: BoxDecoration(
                border: Border.all(color: Colors.grey),
                borderRadius: BorderRadius.circular(8),
              ),
              child: _selectedImage != null
                  ? Image.file(_selectedImage!, fit: BoxFit.cover)
                  : Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Icon(Icons.cloud_upload, size: 40, color: Colors.grey),
                        Text("Tap untuk memilih gambar",
                            style: TextStyle(color: Colors.grey)),
                      ],
                    ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildSubmitButton() {
    return Center(
      child: SizedBox(
        width: double.infinity,
        height: 50,
        child: ElevatedButton(
          style: ElevatedButton.styleFrom(
            backgroundColor: Color(0xFF9E61EB),
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(8),
            ),
          ),
          onPressed: _submitForm,
          child: Text("SUBMIT",
              style: TextStyle(color: Colors.white, fontSize: 16)),
        ),
      ),
    );
  }
}

