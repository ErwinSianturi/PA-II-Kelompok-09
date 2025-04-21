// file: job_list_page.dart
import 'package:flutter/material.dart';
import 'job_card.dart';

class JobListPage extends StatelessWidget {
  const JobListPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Daftar Pekerjaan')),
      body: ListView(
        padding: const EdgeInsets.all(8),
        children: [
          JobCard(
            title: 'Jasa Angkut Barang',
            description: 'Membantu pindahan rumah di area Jakarta Timur',
            time: '2 jam lalu',
            image: Image.asset('assets/images/moving.png'),
            icon: Icons.work,
            color: Colors.blue,
            onTap: () {
              // Navigasi ke detail
            },
            statusWidget: const Text(
              'Menunggu Konfirmasi',
              style: TextStyle(color: Colors.orange),
            ),
          ),
        ],
      ),
    );
  }
}
