import 'package:flutter/material.dart';
import 'package:flutter_application/component/job_card.dart';
import 'package:flutter_application/component/tab_filter.dart';
import 'package:flutter_application/component/job_selector.dart';

class AvailableJobsPage extends StatelessWidget {
  const AvailableJobsPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF5F3FF),
      appBar: AppBar(
        backgroundColor: Colors.transparent,
        elevation: 0,
        leading: const Icon(Icons.arrow_back, color: Colors.black),
        centerTitle: true,
        title: const Text(
          'Pekerjaan Tersedia',
          style: TextStyle(color: Colors.black, fontWeight: FontWeight.bold),
        ),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            const DateSelector(),
            const SizedBox(height: 16),
            const TabFilter(),
            const SizedBox(height: 16),
            Expanded(
              child: ListView(
                children: const [
                  JobCard(
                    title: 'Membersihkan Pekarangan Rumah',
                    description: 'Dibutuhkan tenaga untuk membersihkan pekarangan rumah...',
                    time: '09.00 WIB',
                    status: 'Tersedia',
                    color: Colors.purple,
                    icon: Icons.cleaning_services,
                  ),
                  JobCard(
                    title: 'Membersihkan Properti Rumah',
                    description: 'Saya membutuhkan tenaga untuk membersihkan dalam rumah saya...',
                    time: '10.00 WIB',
                    status: 'Tersedia',
                    color: Colors.purple,
                    icon: Icons.home,
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: BottomNavigationBar(
        selectedItemColor: Colors.purple,
        unselectedItemColor: Colors.grey,
        currentIndex: 0,
        items: const [
          BottomNavigationBarItem(icon: Icon(Icons.home), label: 'Home'),
          BottomNavigationBarItem(icon: Icon(Icons.chat), label: 'Obrolan'),
          BottomNavigationBarItem(icon: Icon(Icons.add_circle_outline), label: 'Beri Kerja'),
          BottomNavigationBarItem(icon: Icon(Icons.work), label: 'Aktivitas'),
          BottomNavigationBarItem(icon: Icon(Icons.person), label: 'Profil'),
        ],
      ),
    );
  }
}
