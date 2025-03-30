import 'package:flutter/material.dart';

class JobCard extends StatelessWidget {
  final String title;
  final String description;
  final String time;
  final String status;

  const JobCard({
    Key? key,
    required this.title,
    required this.description,
    required this.time,
    required this.status,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Card(
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      elevation: 3,
      margin: EdgeInsets.symmetric(vertical: 8.0),
      child: Padding(
        padding: EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            /// Judul pekerjaan
            Text(
              title,
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
            ),

            /// Deskripsi pekerjaan
            SizedBox(height: 4.0),
            Text(
              description,
              style: TextStyle(color: Colors.black87),
            ),

            /// Waktu pekerjaan dengan warna ungu
            SizedBox(height: 4.0),
            Text(
              'Waktu: $time',
              style: TextStyle(color: Colors.purple, fontWeight: FontWeight.w500),
            ),

            /// Status di kanan bawah dalam bentuk badge button
            Align(
              alignment: Alignment.bottomRight,
              child: Container(
                decoration: BoxDecoration(
                  color: _getStatusColor(status).withOpacity(0.2), // Soft color
                  borderRadius: BorderRadius.circular(20),
                ),
                padding: EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                child: Text(
                  status,
                  style: TextStyle(
                    color: _getStatusColor(status),
                    fontSize: 12,
                    fontWeight: FontWeight.w500,
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  /// Fungsi untuk mengatur warna status berdasarkan teksnya
  Color _getStatusColor(String status) {
    switch (status.toLowerCase()) {
      case 'tersedia':
        return Colors.green;
      case 'dalam proses':
        return Colors.orange;
      case 'selesai':
        return Colors.blue;
      default:
        return Colors.black;
    }
  }
}
