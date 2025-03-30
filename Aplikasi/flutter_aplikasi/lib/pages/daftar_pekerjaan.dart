import 'package:flutter/material.dart';
import 'package:flutter_aplikasi/component/job_card.dart'; // Pastikan file ini benar-benar ada

void main() {
  runApp(DaftarPekerjaanPage());
}

class DaftarPekerjaanPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        colorScheme: ColorScheme.fromSwatch(
          primarySwatch: Colors.purple,
        ),
      ),
      home: JobListScreen(),
    );
  }
}

class JobListScreen extends StatelessWidget {
  final List<Map<String, String>> jobs = [
    {
      'title': 'Membersihkan Pekarangan Rumah',
      'time': '09.00 WIB',
      'description': 'Dibutuhkan tenaga untuk membersihkan pekarangan rumah...',
      'status': 'Tersedia'
    },
    {
      'title': 'Mencuci Kendaraan',
      'time': '14.00 WIB',
      'description': 'Dibutuhkan tenaga untuk mencuci mobil saya...',
      'status': 'Dalam Proses'
    },
    {
      'title': 'Membersihkan Properti Rumah',
      'time': '10.00 WIB',
      'description': 'Dibutuhkan tenaga untuk membersihkan rumah...',
      'status': 'Tersedia'
    },
    {
      'title': 'Sofa Cleaning',
      'time': '12.00 WIB',
      'description': 'Dibutuhkan tenaga untuk membersihkan sofa...',
      'status': 'Selesai'
    },
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Daftar Pekerjaan"),
        backgroundColor: Colors.purple,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: ListView.builder(
          itemCount: jobs.length,
          itemBuilder: (context, index) {
            return JobCard(
              title: jobs[index]['title'] ?? "",
              description: jobs[index]['description'] ?? "",
              time: jobs[index]['time'] ?? "",
              status: jobs[index]['status'] ?? "",
            );
          },
        ),
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {},
        child: Icon(Icons.add),
        backgroundColor: Colors.purple,
      ),
      bottomNavigationBar: BottomNavigationBar(
        selectedItemColor: Colors.purple,
        unselectedItemColor: Colors.grey,
        items: [
          BottomNavigationBarItem(icon: Icon(Icons.home), label: "Home"),
          BottomNavigationBarItem(icon: Icon(Icons.chat), label: "Obrolan"),
          BottomNavigationBarItem(icon: Icon(Icons.work), label: "Aktivitas Pekerjaan"),
          BottomNavigationBarItem(icon: Icon(Icons.person), label: "Profil"),
        ],
      ),
    );
  }
}
