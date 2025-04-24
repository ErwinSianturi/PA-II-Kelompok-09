import 'package:flutter/material.dart';
import 'package:flutter_application/pages/activity/tampilan.dart';
import 'package:flutter_application/pages/profil/profil.dart';

class ViewApplicantsPage extends StatelessWidget {
  const ViewApplicantsPage({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[100],
      appBar: AppBar(
        title: const Text("Pelamar Pekerjaan"),
        backgroundColor: Colors.white,
        foregroundColor: Colors.black,
        elevation: 1,
      ),
      body: ListView(
        padding: const EdgeInsets.all(16),
        children: [
          _applicantCard(context, 'assets/imel.png', 'Imel Sari Sinaga'),
          _applicantCard(context, 'assets/profile.jpg', 'Yenny Gurning'),
          _applicantCard(context, 'assets/Rmh.png', 'Erwin Sianturi'),
        ],
      ),
    );
  }

  Widget _applicantCard(BuildContext context, String imagePath, String name) {
    return Card(
      elevation: 3,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
      margin: const EdgeInsets.only(bottom: 16),
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 20),
        child: Column(
          children: [
            CircleAvatar(
              backgroundImage: AssetImage(imagePath),
              radius: 45,
            ),
            const SizedBox(height: 12),
            Text(
              name,
              style: const TextStyle(
                fontSize: 18,
                fontWeight: FontWeight.w600,
              ),
            ),
            const SizedBox(height: 16),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
              children: [
                ElevatedButton.icon(
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (_) => const AktivitasPekerjaanPage()),
                    );
                  },
                  icon: const Icon(Icons.visibility),
                  label: const Text("Lihat"),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.teal,
                    foregroundColor: Colors.white,
                    padding: const EdgeInsets.symmetric(horizontal: 18, vertical: 10),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                  ),
                ),
                ElevatedButton.icon(
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (_) => ProfilPage()),
                    );
                  },
                  icon: const Icon(Icons.person),
                  label: const Text("Profil"),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.deepPurple,
                    foregroundColor: Colors.white,
                    padding: const EdgeInsets.symmetric(horizontal: 18, vertical: 10),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                  ),
                ),
              ],
            )
          ],
        ),
      ),
    );
  }
}
