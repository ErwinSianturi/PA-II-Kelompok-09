import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter_application/pages/home/models/job.dart';
import 'form_daftar_kerja.dart'; // Import halaman FormDaftarKerja

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
                onPressed: () {
                  // Aksi untuk negosiasi
                },
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
                  // Arahkan ke halaman FormDaftarKerja
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => FormDaftarKerja(),
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
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            ClipRRect(
              borderRadius: BorderRadius.circular(12),
              child: Image.file(
                File(job.gambar),
                width: double.infinity,
                height: 180,
                fit: BoxFit.cover,
              ),
            ),
            SizedBox(height: 16),
            Text(
              "${job.kategori}\n${job.judul}",
              style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
            ),
            SizedBox(height: 8),
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
            Text(
              "RP ${job.harga},00",
              style: TextStyle(color: Colors.green, fontSize: 20, fontWeight: FontWeight.bold),
            ),
            Divider(height: 32),
            Text("Deskripsi", style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
            SizedBox(height: 4),
            Text(job.deskripsi),
          ],
        ),
      ),
    );
  }
}
