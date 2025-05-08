import 'dart:io';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:http/http.dart' as http;
import 'package:http_parser/http_parser.dart';
import 'package:path/path.dart' as path;

class TambahPertanyaanPage extends StatefulWidget {
  @override
  _TambahPertanyaanPageState createState() => _TambahPertanyaanPageState();
}

class _TambahPertanyaanPageState extends State<TambahPertanyaanPage> {
  String? selectedHelpOption;
  File? _selectedFile;
  final TextEditingController deskripsiController = TextEditingController();
  final TextEditingController namaController = TextEditingController();
  final TextEditingController emailController = TextEditingController();
  final TextEditingController telpController = TextEditingController();

  final ImagePicker _picker = ImagePicker();
  bool isLoading = false;

  // Fungsi untuk memilih gambar dari galeri
  Future<void> _pickImage() async {
    final pickedFile = await _picker.pickImage(source: ImageSource.gallery);

    if (pickedFile != null) {
      setState(() {
        _selectedFile = File(pickedFile.path);
      });
    }
  }

  // Fungsi untuk memilih gambar dari kamera
  Future<void> _pickImageFromCamera() async {
    final pickedFile = await _picker.pickImage(source: ImageSource.camera);

    if (pickedFile != null) {
      setState(() {
        _selectedFile = File(pickedFile.path);
      });
    }
  }

  // Fungsi untuk menampilkan dialog pilihan sumber gambar
  void _showImageSourceDialog() {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Pilih Sumber Gambar'),
          content: SingleChildScrollView(
            child: ListBody(
              children: <Widget>[
                GestureDetector(
                  child: Text('Galeri'),
                  onTap: () {
                    Navigator.of(context).pop();
                    _pickImage();
                  },
                ),
                Padding(padding: EdgeInsets.all(8.0)),
                GestureDetector(
                  child: Text('Kamera'),
                  onTap: () {
                    Navigator.of(context).pop();
                    _pickImageFromCamera();
                  },
                ),
              ],
            ),
          ),
        );
      },
    );
  }

  // Fungsi untuk mengirimkan request bantuan
  Future<void> _submitHelpRequest(BuildContext context) async {
    // Validasi input
    if (selectedHelpOption == null || selectedHelpOption == '-') {
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text('Silakan pilih jenis bantuan.')));
      return;
    }

    if (deskripsiController.text.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text('Deskripsi tidak boleh kosong.')));
      return;
    }

    if (namaController.text.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text('Nama tidak boleh kosong.')));
      return;
    }

    if (emailController.text.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text('Email tidak boleh kosong.')));
      return;
    }

    if (_selectedFile == null) {
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text('Silakan pilih gambar untuk lampiran.')));
      return;
    }

    setState(() {
      isLoading = true;
    });

    // URL API - Pastikan sesuai dengan alamat server Golang Anda
    // Untuk emulator Android, gunakan 10.0.2.2 sebagai pengganti localhost
    final uri = Uri.parse('http://10.0.2.2:8080/help-requests');
    
    var request = http.MultipartRequest('POST', uri);

    // Menambahkan field data ke form request
    request.fields['help_option'] = selectedHelpOption ?? '';
    request.fields['description'] = deskripsiController.text;
    request.fields['full_name'] = namaController.text;
    request.fields['email'] = emailController.text;
    request.fields['phone'] = telpController.text;

    // Menentukan tipe konten berdasarkan ekstensi file
    String extension = path.extension(_selectedFile!.path).toLowerCase();
    String contentType = 'image/jpeg'; // Default
    
    if (extension == '.png') {
      contentType = 'image/png';
    } else if (extension == '.jpg' || extension == '.jpeg') {
      contentType = 'image/jpeg';
    }

    // Menambahkan file
    var file = await http.MultipartFile.fromPath(
      'attachment',
      _selectedFile!.path,
      contentType: MediaType.parse(contentType),
    );
    request.files.add(file);

    // Kirim request ke API
    try {
      var streamedResponse = await request.send();
      var response = await http.Response.fromStream(streamedResponse);
      
      setState(() {
        isLoading = false;
      });
      
      if (response.statusCode == 201) { // 201 Created
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Permintaan bantuan berhasil dikirim'),
            backgroundColor: Colors.green,
          )
        );
        
        // Reset form setelah berhasil
        setState(() {
          selectedHelpOption = null;
          _selectedFile = null;
          deskripsiController.clear();
          namaController.clear();
          emailController.clear();
          telpController.clear();
        });
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Gagal mengirim permintaan: ${response.body}'),
            backgroundColor: Colors.red,
          )
        );
      }
    } catch (e) {
      setState(() {
        isLoading = false;
      });
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Terjadi kesalahan: $e'),
          backgroundColor: Colors.red,
        )
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Pusat Bantuan'),
        centerTitle: true,
        backgroundColor: Colors.white,
        foregroundColor: Colors.black,
        elevation: 0,
      ),
      body: Padding(
        padding: EdgeInsets.symmetric(horizontal: 20),
        child: ListView(
          children: [
            SizedBox(height: 10),
            Text('Apa yang bisa kami bantu?', style: TextStyle(fontWeight: FontWeight.bold)),
            SizedBox(height: 5),
            DropdownButtonFormField<String>(
              value: selectedHelpOption,
              items: ['-', 'Masalah Akun', 'Kendala Teknis', 'Lainnya'].map((option) {
                return DropdownMenuItem(value: option, child: Text(option));
              }).toList(),
              onChanged: (value) {
                setState(() {
                  selectedHelpOption = value;
                });
              },
              decoration: InputDecoration(border: OutlineInputBorder()),
            ),
            SizedBox(height: 15),
            Text('Deskripsi', style: TextStyle(fontWeight: FontWeight.bold)),
            SizedBox(height: 5),
            TextField(
              controller: deskripsiController,
              maxLines: 4,
              decoration: InputDecoration(
                border: OutlineInputBorder(),
                hintText: 'Jelaskan masalah Anda secara detail',
              ),
            ),
            SizedBox(height: 15),
            Text('Nama Lengkap Anda', style: TextStyle(fontWeight: FontWeight.bold)),
            TextField(
              controller: namaController,
              decoration: InputDecoration(
                border: OutlineInputBorder(),
                hintText: 'Masukkan nama lengkap Anda',
              ),
            ),
            SizedBox(height: 15),
            Text('Alamat Email Anda', style: TextStyle(fontWeight: FontWeight.bold)),
            TextField(
              controller: emailController,
              decoration: InputDecoration(
                border: OutlineInputBorder(),
                hintText: 'Masukkan alamat email Anda',
              ),
              keyboardType: TextInputType.emailAddress,
            ),
            SizedBox(height: 15),
            Text('Nomor Telepon Anda', style: TextStyle(fontWeight: FontWeight.bold)),
            TextField(
              controller: telpController,
              decoration: InputDecoration(
                border: OutlineInputBorder(),
                hintText: 'Masukkan nomor telepon Anda',
              ),
              keyboardType: TextInputType.phone,
            ),
            SizedBox(height: 15),
            Text('Lampiran', style: TextStyle(fontWeight: FontWeight.bold)),
            GestureDetector(
              onTap: _showImageSourceDialog, // Menampilkan dialog pilihan sumber gambar
              child: Container(
                height: 150,
                decoration: BoxDecoration(
                  border: Border.all(color: Colors.black45),
                  borderRadius: BorderRadius.circular(5),
                ),
                child: Center(
                  child: _selectedFile == null
                      ? Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Icon(Icons.cloud_upload_outlined, size: 30),
                            SizedBox(height: 5),
                            Text("Klik untuk memilih gambar", style: TextStyle(color: Colors.black45)),
                          ],
                        )
                      : Image.file(
                          _selectedFile!,
                          width: 100,
                          height: 100,
                          fit: BoxFit.cover,
                        ),
                ),
              ),
            ),
            SizedBox(height: 25),
            // Button Kirim
            SizedBox(
              width: double.infinity,
              height: 50,
              child: ElevatedButton(
                onPressed: isLoading ? null : () => _submitHelpRequest(context),
                style: ElevatedButton.styleFrom(
                  backgroundColor: Color(0xFFBB86FC),
                  disabledBackgroundColor: Colors.grey,
                ),
                child: isLoading
                    ? CircularProgressIndicator(color: Colors.white)
                    : Text("Kirim", style: TextStyle(fontSize: 16)),
              ),
            ),
            SizedBox(height: 20),
            Row(
              children: [
                Expanded(child: Divider()),
                Padding(
                  padding: EdgeInsets.symmetric(horizontal: 8),
                  child: Text("atau"),
                ),
                Expanded(child: Divider()),
              ],
            ),
            SizedBox(height: 15),
            SizedBox(
              width: double.infinity,
              height: 50,
              child: ElevatedButton(
                onPressed: () {
                  // Aksi hubungi via email
                  ScaffoldMessenger.of(context).showSnackBar(
                    SnackBar(content: Text('Fitur email belum tersedia'))
                  );
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Color(0xFFBB86FC),
                ),
                child: Text("Hubungi Melalui Email", style: TextStyle(fontSize: 16)),
              ),
            ),
            SizedBox(height: 20),
          ],
        ),
      ),
    );
  }
}
