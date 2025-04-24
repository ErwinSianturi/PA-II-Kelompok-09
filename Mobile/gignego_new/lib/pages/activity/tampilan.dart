import 'package:flutter/material.dart';
import 'package:flutter_application/pages/homepage/home_page.dart';
import 'package:flutter_application/pages/profil/profil.dart';
import 'package:flutter_application/pages/activity/lihat_aktivitas.dart';

class AktivitasPekerjaanPage extends StatelessWidget {
  const AktivitasPekerjaanPage({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Aktivitas Pekerjaan"),
        elevation: 0,
        backgroundColor: Colors.white,
        foregroundColor: Colors.black,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            Expanded(
              child: ListView(
                children: [
                  const SizedBox(height: 24),
                  TaskItem(
                    title: "Membersihkan Pekarangan Rumah",
                    subtitle: "Hari ini",
                    subtitleColor: Colors.red,
                    dateText: "25 Apr",
                    dateColor: Colors.purple,
                    leadingImage: 'assets/Rmh.png',
                  ),
                  TaskItem(
                    title: "Mencuci Kendaraan",
                    subtitle: "Hari ini",
                    subtitleColor: Colors.red,
                    dateText: "25 Apr",
                    dateColor: Colors.purple,
                    leadingImage: 'assets/Mobil.png',
                  ),
                  TaskItem(
                    title: "Membersihkan Properti Rumah",
                    subtitle: "Hari ini",
                    subtitleColor: Colors.red,
                    dateText: "25 Apr",
                    dateColor: Colors.purple,
                    leadingImage: 'assets/Properti.png',
                  ),
                  TaskItem(
                    title: "Sofa Cleaning",
                    subtitle: "Hari ini",
                    subtitleColor: Colors.red,
                    dateText: "25 Apr",
                    dateColor: Colors.purple,
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
          print("FAB ditekan");
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
  final IconData? trailingIcon;
  final int? trailingNumber;
  final String leadingImage;

  const TaskItem({
    super.key,
    required this.title,
    required this.subtitle,
    this.subtitleColor,
    this.dateText,
    this.dateColor,
    this.trailingIcon,
    this.trailingNumber,
    required this.leadingImage,
  });

  @override
  Widget build(BuildContext context) {
    return Card(
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
      elevation: 4,
      margin: const EdgeInsets.only(bottom: 16),
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              children: [
                Image.asset(
                  leadingImage,
                  width: 40,
                  height: 40,
                  fit: BoxFit.cover,
                ),
                const SizedBox(width: 10),
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
                if (dateText != null)
                  Text(
                    dateText!,
                    style: TextStyle(color: dateColor ?? Colors.black),
                  ),
                if (trailingIcon != null)
                  Icon(trailingIcon, color: Colors.purple),
                if (trailingNumber != null)
                  Container(
                    padding:
                        const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                    decoration: BoxDecoration(
                      color: Colors.purple[100],
                      borderRadius: BorderRadius.circular(12),
                    ),
                    child: Text(
                      trailingNumber.toString(),
                      style: const TextStyle(color: Colors.purple),
                    ),
                  ),
              ],
            ),
            const SizedBox(height: 12),
            Align(
              alignment: Alignment.centerRight,
              child: ElevatedButton(
                onPressed: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (_) => const LihatAktivitasPage()),
                  );
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color.fromARGB(255, 213, 57, 241),
                  padding: const EdgeInsets.symmetric(
                      horizontal: 20, vertical: 10),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(8),
                  ),
                ),
                child: const Text(
                  "Lihat Detail",
                  style: TextStyle(color: Colors.white),
                ),
              ),
            )
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
