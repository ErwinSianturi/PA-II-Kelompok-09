import 'package:flutter/material.dart';

class JobDetailPage extends StatelessWidget {
  final String jobTitle = "Kebersihan";
  final String email = "imel@gmail.com";
  final String jobPrice = "Rp. 230,000";
  final String jobStatus = "Dalam Proses";
  final String jobType = "Kebersihan";
  final String jobDescription = "Lakukan pekerjaan kebersihan rumah dengan teliti dan rapi.";
  final String termsAndConditions = "Syarat dan ketentuan berlaku.";
  final String workScope = "Membersihkan seluruh area rumah.";
  final String workDuration = "5 Jam";
  final String jobImage = "imel.png";

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(jobTitle),
        centerTitle: true,
        elevation: 0,
        backgroundColor: Colors.purple,
        flexibleSpace: Container(
          decoration: BoxDecoration(
            gradient: LinearGradient(
              colors: [Colors.purple, Colors.deepPurple],
              begin: Alignment.topLeft,
              end: Alignment.bottomRight,
            ),
          ),
        ),
      ),
      body: SingleChildScrollView(
        padding: EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            ClipRRect(
              borderRadius: BorderRadius.circular(15),
              child: Image.asset(
                jobImage,
                width: double.infinity,
                height: 200,
                fit: BoxFit.cover,
              ),
            ),
            SizedBox(height: 16),
            Text(
              "Nama Pekerjaan: $jobTitle",
              style: TextStyle(
                fontSize: 22,
                fontWeight: FontWeight.bold,
                color: Colors.purple,
              ),
            ),
            SizedBox(height: 8),
            Text("Email: $email", style: TextStyle(fontSize: 16, color: Colors.black)),
            Text("Harga Pekerjaan: $jobPrice", style: TextStyle(fontSize: 16, color: Colors.black)),
            Text("Status Pekerjaan: $jobStatus", style: TextStyle(fontSize: 16, color: Colors.black)),
            Text("Jenis Pekerjaan: $jobType", style: TextStyle(fontSize: 16, color: Colors.black)),
            SizedBox(height: 16),
            _sectionTitle("Deskripsi Pekerjaan"),
            Text(jobDescription, style: TextStyle(fontSize: 16, color: Colors.black54)),
            SizedBox(height: 16),
            _sectionTitle("Syarat dan Ketentuan"),
            Text(termsAndConditions, style: TextStyle(fontSize: 16, color: Colors.black54)),
            SizedBox(height: 16),
            _sectionTitle("Lingkup Kerja"),
            Text(workScope, style: TextStyle(fontSize: 16, color: Colors.black54)),
            SizedBox(height: 16),
            _sectionTitle("Lama Pekerjaan"),
            Text(workDuration, style: TextStyle(fontSize: 16, color: Colors.black54)),
            SizedBox(height: 24),
            Center(
              child: ElevatedButton(
                onPressed: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => ConfirmationPage()),
                  );
                },
                style: ElevatedButton.styleFrom(
                  padding: EdgeInsets.symmetric(horizontal: 50, vertical: 15),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(20), // Radius lebih besar untuk tombol
                  ),
                  shadowColor: Colors.deepPurpleAccent, // Efek bayangan tombol
                  elevation: 10, // Menambahkan efek elevasi
                ),
                child: Text(
                  'Daftar ke Pekerjaan Ini',
                  style: TextStyle(color: Colors.white, fontSize: 16),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _sectionTitle(String title) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 8.0),
      child: Text(
        title,
        style: TextStyle(
          fontSize: 18,
          fontWeight: FontWeight.bold,
          color: Colors.deepPurple,
        ),
      ),
    );
  }
}

class ConfirmationPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Pendaftaran Berhasil'),
        backgroundColor: Colors.deepPurple,
      ),
      body: Center(
        child: Text(
          'Anda telah mendaftar untuk pekerjaan!',
          style: TextStyle(fontSize: 20, color: Colors.deepPurple),
        ),
      ),
    );
  }
}

void main() {
  runApp(MaterialApp(
    debugShowCheckedModeBanner: false,
    home: JobDetailPage(),
  ));
}
