import 'package:flutter/material.dart';
import 'package:flutter_application/pages/activity/edit.dart';
import 'package:flutter_application/pages/activity/delete.dart';
import 'package:flutter_application/pages/activity/view_applicants.dart';

class LihatAktivitasPage extends StatelessWidget {
  const LihatAktivitasPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Daftar Pekerjaan"),
        backgroundColor: const Color.fromARGB(255, 248, 248, 248),
        elevation: 1,
      ),
      body: ListView(
        padding: const EdgeInsets.all(16),
        children: const [
          JobCard(
            imagePath: 'assets/Rmh.png',
            jobName: 'Membersihkan Pekarangan Rumah',
            price: 'Rp. 500.000',
            status: 'Tersedia',
            jobType: 'Kebersihan',
            time: '10:00',
            applicants: '15',
          ),
          JobCard(
            imagePath: 'assets/Rmh.png',
            jobName: 'Mencuci Kendaraan',
            price: 'Rp. 100.000',
            status: 'Dalam Proses',
            jobType: 'Kebersihan',
            time: '14:00',
            applicants: '8',
          ),
          JobCard(
            imagePath: 'assets/Rmh.png',
            jobName: 'Sofa Cleaning',
            price: 'Rp. 300.000',
            status: 'Selesai',
            jobType: 'Kebersihan',
            time: '09:00',
            applicants: '5',
          ),
        ],
      ),
    );
  }
}

class JobCard extends StatelessWidget {
  final String imagePath;
  final String jobName;
  final String price;
  final String status;
  final String jobType;
  final String time;
  final String applicants;

  const JobCard({
    super.key,
    required this.imagePath,
    required this.jobName,
    required this.price,
    required this.status,
    required this.jobType,
    required this.time,
    required this.applicants,
  });

  @override
  Widget build(BuildContext context) {
    return Card(
      elevation: 3,
      margin: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Row(
          children: [
            ClipRRect(
              borderRadius: BorderRadius.circular(12),
              child: Image.asset(imagePath, width: 90, height: 90, fit: BoxFit.cover),
            ),
            const SizedBox(width: 16),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(jobName, style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 18)),
                  const SizedBox(height: 4),
                  Text(price, style: const TextStyle(color: Colors.green, fontSize: 16)),

                  Container(
                    width: 100,
                    height: 8,
                    decoration: BoxDecoration(
                      color: _getStatusColor(),
                      borderRadius: BorderRadius.circular(8),
                    ),
                  ),
                  const SizedBox(height: 4),
                  Text(
                    status,
                    style: const TextStyle(
                      fontSize: 14,
                      fontWeight: FontWeight.bold,
                      color: Colors.red,
                    ),
                  ),
                  const SizedBox(height: 8),
                  Text("Jenis: $jobType", style: const TextStyle(fontSize: 14)),
                  Text("Waktu: $time jam", style: const TextStyle(fontSize: 14)),
                  Text("Pelamar: $applicants", style: const TextStyle(fontSize: 14)),
                  const SizedBox(height: 12),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                    children: [
                      _actionButton("Edit", Colors.orange, () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(builder: (_) => const EditPekerjaanPage()),
                        );
                      }),
                      _actionButton("Delete", Colors.red, () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(builder: (_) => const DeletePekerjaanPage()),
                        );
                      }),
                      _actionButton("View", Colors.teal, () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(builder: (_) => const ViewApplicantsPage()),
                        );
                      }, padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 6)),
                    ],
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

Color? _getStatusColor() {
  switch (status) {
    case "Tersedia":
    case "Dalam Proses":
    case "Selesai":
    default:
      return null;
  }
}

  Widget _actionButton(String text, Color color, VoidCallback onTap, {EdgeInsets? padding}) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        padding: padding ?? const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
        decoration: BoxDecoration(
          color: color,
          borderRadius: BorderRadius.circular(8),
        ),
        child: Text(text, style: const TextStyle(color: Colors.white)),
      ),
    );
  }
}
