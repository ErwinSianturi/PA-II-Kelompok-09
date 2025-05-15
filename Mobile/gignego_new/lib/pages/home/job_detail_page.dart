import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter_application/pages/models/job.dart';
import 'package:flutter_application/pages/home/form_daftar_kerja.dart';

class JobDetailPage extends StatelessWidget {
  final Job job;

  const JobDetailPage({super.key, required this.job});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Detail'),
        centerTitle: true,
        leading: IconButton(
          icon: Icon(Icons.arrow_back),
          onPressed: () => Navigator.pop(context),
        ),
        elevation: 0,
      ),
      bottomNavigationBar: Container(
        padding: EdgeInsets.symmetric(horizontal: 16, vertical: 12),
        decoration: BoxDecoration(
          border: Border(top: BorderSide(color: Colors.grey.shade300)),
          color: Colors.white,
        ),
        child: Row(
          children: [
            Expanded(
              child: ElevatedButton(
                onPressed: () {},
                style: ElevatedButton.styleFrom(
                  backgroundColor: Color(0xFF9E61EB),
                ),
                child: Text(
                  'Lakukan Negosiasi',
                  style: TextStyle(color: Colors.white),
                ),
              ),
            ),
            SizedBox(width: 12),
            Expanded(
              child: ElevatedButton(
                onPressed: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => TambahPengalamanKerjaPage(),
                    ),
                  );
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Color(0xFF9E61EB),
                ),
                child: Text(
                  'Daftar Sekarang',
                  style: TextStyle(color: Colors.white),
                ),
              ),
            ),
          ],
        ),
      ),
      body: SingleChildScrollView(
        padding: EdgeInsets.all(16),
        child: Column(
          children: [
            // Menampilkan Gambar 1
            if (job.gambar1.isNotEmpty)
              ClipRRect(
                borderRadius: BorderRadius.circular(12),
                child: Image.file(
                  File(job.gambar1),  // Gambar 1
                  width: double.infinity,
                  height: 180,
                  fit: BoxFit.cover,
                ),
              ),
            SizedBox(height: 10),

            // Menampilkan Gambar 2
            if (job.gambar2.isNotEmpty)
              ClipRRect(
                borderRadius: BorderRadius.circular(12),
                child: Image.file(
                  File(job.gambar2),  // Gambar 2
                  width: double.infinity,
                  height: 180,
                  fit: BoxFit.cover,
                ),
              ),
            SizedBox(height: 10),

            // Menampilkan Gambar 3
            if (job.gambar3.isNotEmpty)
              ClipRRect(
                borderRadius: BorderRadius.circular(12),
                child: Image.file(
                  File(job.gambar3),  // Gambar 3
                  width: double.infinity,
                  height: 180,
                  fit: BoxFit.cover,
                ),
              ),
            SizedBox(height: 16),

            // Menampilkan Nama Pekerjaan dan Jenis Pekerjaan
            Text(
              "${job.jenisPekerjaan}\n${job.namaPekerjaan}",
              style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
            ),
            SizedBox(height: 8),

            // Menampilkan Tanggal Pekerjaan
            Row(
              children: [
                Text("Tanggal: ", style: TextStyle(color: Colors.grey[600])),
                Text(
                  job.tanggal,
                  style: TextStyle(color: Color(0xFF9E61EB)),
                ),
              ],
            ),
            Row(
              children: [
                Text("Waktu: ", style: TextStyle(color: Colors.grey[600])),
                Text(
                  job.waktu,
                  style: TextStyle(color: Color(0xFF9E61EB)),
                ),
              ],
            ),
            SizedBox(height: 8),

            // Menampilkan Harga Pekerjaan
            Text(
              "RP ${job.hargaPekerjaan},00",
              style: TextStyle(
                  color: Colors.green,
                  fontSize: 20,
                  fontWeight: FontWeight.bold),
            ),
            Divider(height: 32),

            // Deskripsi
            Text("Deskripsi",
                style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
            SizedBox(height: 4),
            Text(job.deskripsi),
          ],
        ),
      ),
    );
  }
}
