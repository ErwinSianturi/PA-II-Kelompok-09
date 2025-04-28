import 'package:flutter/material.dart';
import 'package:flutter_application/pages/home/home_page.dart';
import 'package:flutter_application/pages/profil/profil.dart';
import 'package:flutter_application/pages/activity/daftar_pekerjaan.dart';  
import 'package:flutter_application/pages/home/form_page.dart';

class AktivitasPekerjaanPage extends StatefulWidget {
  const AktivitasPekerjaanPage({Key? key}) : super(key: key);

  @override
  _AktivitasPekerjaanPageState createState() => _AktivitasPekerjaanPageState();
}

class _AktivitasPekerjaanPageState extends State<AktivitasPekerjaanPage> {
  String? _selectedCategory;
  final List<String> _categories = [
    'Semua',
    'Kebersihan Pekarangan',
    'Mencuci Kendaraan',
    'Kebersihan Rumah',
    'Sofa Cleaning',
    'Perbaikan Rumah'
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Aktivitas Pekerjaan"),
        elevation: 0,
        backgroundColor: Colors.deepPurple,
        foregroundColor: Colors.white,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            DropdownButtonFormField<String>(
              decoration: const InputDecoration(
                labelText: 'Jenis Pekerjaan',
                border: OutlineInputBorder(),
              ),
              value: _selectedCategory,
              items: _categories.map((category) {
                return DropdownMenuItem(
                  value: category,
                  child: Text(category),
                );
              }).toList(),
              onChanged: (value) {
                setState(() {
                  _selectedCategory = value;
                });
              },
            ),
            const SizedBox(height: 24),
            Expanded(
              child: ListView(
                children: [
                  if (_selectedCategory == null || _selectedCategory == 'Semua' || _selectedCategory == 'Kebersihan Pekarangan')
                    TaskItem(
                      title: "Membersihkan Pekarangan Rumah",
                      subtitle: "Tersedia",
                      subtitleColor: Colors.blue,
                      dateText: "25 Apr",
                      dateColor: Colors.red,
                      leadingImage: 'assets/Rmh.png',
                    ),
                  if (_selectedCategory == null || _selectedCategory == 'Semua' || _selectedCategory == 'Mencuci Kendaraan')
                    TaskItem(
                      title: "Mencuci Kendaraan",
                      subtitle: "Tersedia",
                      subtitleColor: Colors.blue,
                      dateText: "25 Apr",
                      dateColor: Colors.red,
                      leadingImage: 'assets/Mobil.png',
                    ),
                  if (_selectedCategory == null || _selectedCategory == 'Semua' || _selectedCategory == 'Kebersihan Rumah')
                    TaskItem(
                      title: "Membersihkan Properti Rumah",
                      subtitle: "Tersedia",
                      subtitleColor: Colors.blue,
                      dateText: "25 Apr",
                      dateColor: Colors.red,
                      leadingImage: 'assets/Properti.png',
                    ),
                  if (_selectedCategory == null || _selectedCategory == 'Semua' || _selectedCategory == 'Sofa Cleaning')
                    TaskItem(
                      title: "Sofa Cleaning",
                      subtitle: "Tersedia",
                      subtitleColor: Colors.blue,
                      dateText: "25 Apr",
                      dateColor: Colors.red,
                      leadingImage: 'assets/sofa.png',
                    ),
                ],
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: const BottomNavBar(),
      floatingActionButton: CustomFAB(
        onPressed: () {
          Navigator.push(
            context,
            MaterialPageRoute(builder: (_) => EditPekerjaanPage()), 
          );
        },
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
    );
  }
}

class TaskItem extends StatelessWidget {
  final String title;
  final String subtitle;
  final Color? subtitleColor;
  final String? dateText;
  final Color? dateColor;
  final String leadingImage;

  const TaskItem({
    super.key,
    required this.title,
    required this.subtitle,
    this.subtitleColor,
    this.dateText,
    this.dateColor,
    required this.leadingImage,
  });

  @override
  Widget build(BuildContext context) {
    return Card(
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      elevation: 4,
      margin: const EdgeInsets.only(bottom: 16),
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Row(
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            Image.asset(
              leadingImage,
              width: 50,
              height: 50,
              fit: BoxFit.cover,
            ),
            const SizedBox(width: 16),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    title,
                    style: const TextStyle(
                      fontSize: 16,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  const SizedBox(height: 4),
                  Text(
                    subtitle,
                    style: TextStyle(
                      color: subtitleColor ?? Colors.grey[600],
                      fontSize: 13,
                    ),
                  ),
                ],
              ),
            ),
            Column(
              mainAxisSize: MainAxisSize.min,
              children: [
                if (dateText != null)
                  Text(
                    dateText!,
                    style: TextStyle(color: dateColor ?? Colors.black),
                  ),
                const SizedBox(height: 8),
                ElevatedButton(
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (_) => FormPage(
                          onJobAdded: (newJob) {
                            ScaffoldMessenger.of(context).showSnackBar(
                              const SnackBar(content: Text('Pekerjaan berhasil ditambahkan!')),
                            );
                          },
                        ),
                      ),
                    );
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.deepPurple,
                    padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(8),
                    ),
                  ),
                  child: const Text(
                    "Tambahkan",
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 12,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }
}

class BottomNavBar extends StatelessWidget {
  const BottomNavBar({super.key});

  @override
  Widget build(BuildContext context) {
    return BottomAppBar(
      shape: const CircularNotchedRectangle(),
      notchMargin: 8,
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 3),
        height: 60,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceAround,
          children: [
            IconButton(
              icon: Image.asset("assets/home.png", width: 30, height: 30),
              onPressed: () {
                Navigator.pushReplacement(context,
                    MaterialPageRoute(builder: (_) => HomePage()));
              },
            ),
            IconButton(
              icon: Image.asset("assets/obrolan.png", width: 30, height: 30),
              onPressed: () {},
            ),
            const SizedBox(width: 30),
            IconButton(
              icon: Image.asset("assets/aktivitas.png", width: 30, height: 30),
              onPressed: () {},
            ),
            IconButton(
              icon: Image.asset("assets/profil.png", width: 30, height: 30),
              onPressed: () {
                Navigator.pushReplacement(context,
                    MaterialPageRoute(builder: (_) => ProfilPage()));
              },
            ),
          ],
        ),
      ),
    );
  }
}

class CustomFAB extends StatelessWidget {
  final VoidCallback? onPressed;

  const CustomFAB({super.key, this.onPressed});

  @override
  Widget build(BuildContext context) {
    return FloatingActionButton(
      onPressed: onPressed ?? () => print("FAB ditekan"),
      shape: const CircleBorder(),
      elevation: 6,
      backgroundColor: Colors.white,
      child: Container(
        padding: const EdgeInsets.all(5),
        decoration: const BoxDecoration(
          shape: BoxShape.circle,
          gradient: SweepGradient(
            colors: [
              Color(0xFF2979FF),
              Color(0xFF80BF80),
              Color(0xFF15AFFF),
              Color(0xFF00E5FF),
              Color(0xFFFF9800),
              Color(0xFF2979FF),
            ],
          ),
        ),
        child: Container(
          decoration: const BoxDecoration(
            color: Colors.white,
            shape: BoxShape.circle,
          ),
          child: const Center(
            child: Icon(Icons.add, color: Colors.black, size: 30),
          ),
        ),
      ),
    );
  }
}
