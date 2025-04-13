import 'package:flutter/material.dart';
import 'package:flutter_application/component/job_card.dart';
import 'package:flutter_application/component/job_selector.dart';
import 'package:flutter_application/pages/job_done.dart';

class AllJobsPage extends StatelessWidget {
  const AllJobsPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF5F3FF),
      appBar: AppBar(
        backgroundColor: Colors.transparent,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.black),
          onPressed: () => Navigator.pop(context),
        ),
        centerTitle: true,
        title: const Text(
          'Pekerjaan Selesai',
          style: TextStyle(color: Colors.black, fontWeight: FontWeight.bold),
        ),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            const DateSelector(),
            const SizedBox(height: 16),
            Expanded(
              child: ListView(
                children: [
                  JobCard(
                    title: 'Sofa Cleaning',
                    description: 'Dibutuhkan tenaga untuk membersihkan sofa saya...',
                    time: 'Pengerjaan: 12.00 WIB',
                    color: Colors.green,
                    icon: Icons.check_circle,
                    image: Image.asset('assets/images/cleaning.png'),
                    onTap: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(builder: (context) => const JobDonePage()),
                      );
                    },
                    statusWidget: const Text(
                      'Selesai',
                      style: TextStyle(color: Colors.green, fontWeight: FontWeight.bold),
                    ),
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
