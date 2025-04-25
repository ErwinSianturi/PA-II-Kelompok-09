import 'package:flutter/material.dart';

class JobApplicationPage extends StatefulWidget {
  @override
  _JobApplicationPageState createState() => _JobApplicationPageState();
}

class _JobApplicationPageState extends State<JobApplicationPage> {
  final _formKey = GlobalKey<FormState>();
  final TextEditingController _reasonController = TextEditingController();
  final TextEditingController _fitReasonController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Pendaftaran Pekerjaan"),
        centerTitle: true,
        backgroundColor: Colors.purple,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: SingleChildScrollView(
          child: Form(
            key: _formKey,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  "Alasan Mengambil Pekerjaan: Kebersihan Lapangan",
                  style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                ),
                SizedBox(height: 16),
                Text(
                  "Harga Jasa: Rp. 20,000",
                  style: TextStyle(fontSize: 16),
                ),
                SizedBox(height: 8),
                Text(
                  "Waktu Jasa: 4 Jam",
                  style: TextStyle(fontSize: 16),
                ),
                SizedBox(height: 24),
                Text(
                  "Alasan Anda Cocok untuk Pekerjaan Ini:",
                  style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                ),
                SizedBox(height: 8),
                TextFormField(
                  controller: _reasonController,
                  maxLines: 5,
                  decoration: InputDecoration(
                    labelText: 'Jelaskan mengapa Anda memilih pekerjaan ini',
                    border: OutlineInputBorder(),
                    hintText: 'Masukkan alasan Anda memilih pekerjaan ini...',
                  ),
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Harap masukkan alasan Anda memilih pekerjaan ini.';
                    }
                    return null;
                  },
                ),
                SizedBox(height: 16),
                Text(
                  "Alasan Mengapa Anda Cocok untuk Pekerjaan Ini:",
                  style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                ),
                SizedBox(height: 8),
                TextFormField(
                  controller: _fitReasonController,
                  maxLines: 5,
                  decoration: InputDecoration(
                    labelText: 'Jelaskan mengapa Anda cocok untuk pekerjaan ini',
                    border: OutlineInputBorder(),
                    hintText: 'Masukkan alasan Anda cocok untuk pekerjaan ini...',
                  ),
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Harap masukkan alasan mengapa Anda cocok untuk pekerjaan ini.';
                    }
                    return null;
                  },
                ),
                SizedBox(height: 24),
                Center(
                  child: ElevatedButton(
                    onPressed: () {
                      if (_formKey.currentState?.validate() ?? false) {
                        // Jika form valid, bisa melanjutkan ke halaman selanjutnya atau melakukan aksi
                        ScaffoldMessenger.of(context).showSnackBar(
                          SnackBar(content: Text('Pendaftaran Berhasil!')),
                        );
                      }
                    },
                    style: ElevatedButton.styleFrom(
                      padding: EdgeInsets.symmetric(horizontal: 50, vertical: 15),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12),
                      ),
                    ),
                    child: Text(
                      'Kirim Pendaftaran',
                      style: TextStyle(color: Colors.white, fontSize: 16),
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

void main() {
  runApp(MaterialApp(
    home: JobApplicationPage(),
  ));
}
