import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class ProfilePage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: 4,
        items: [
          BottomNavigationBarItem(icon: Icon(Icons.home), label: "Home"),
          BottomNavigationBarItem(icon: Icon(Icons.chat), label: "Obrolan"),
          BottomNavigationBarItem(icon: Icon(Icons.add_circle, size: 40), label: "Beri Kerja"),
          BottomNavigationBarItem(icon: Icon(Icons.work), label: "Aktivitas Pekerjaan"),
          BottomNavigationBarItem(icon: Icon(Icons.person), label: "Profil"),
        ],
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            Container(
              padding: EdgeInsets.symmetric(vertical: 20),
              decoration: BoxDecoration(
                gradient: LinearGradient(
                  colors: [Colors.purple.shade300, Colors.purple.shade700],
                  begin: Alignment.topCenter,
                  end: Alignment.bottomCenter,
                ),
              ),
              child: Column(
                children: [
                  CircleAvatar(
                    radius: 50,
                    backgroundImage: AssetImage("assets/profile_placeholder.png"), // Ganti dengan foto profil
                  ),
                  SizedBox(height: 10),
                  Text(
                    "Yenny Angelita Gurning",
                    style: GoogleFonts.poppins(
                      fontSize: 18, fontWeight: FontWeight.bold, color: Colors.white),
                  ),
                  Text(
                    "Profil Belum Lengkap",
                    style: GoogleFonts.poppins(fontSize: 14, color: Colors.white70),
                  ),
                  ElevatedButton(
                    onPressed: () {},
                    child: Text("Edit Profil"),
                  ),
                  SizedBox(height: 10),
                  Card(
                    margin: EdgeInsets.symmetric(horizontal: 20),
                    child: Padding(
                      padding: EdgeInsets.all(15),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceAround,
                        children: [
                          _buildStat("Penghasilan Belum Jatuh Tempo", "50.000,00"),
                          _buildStat("Aset Penghasilan", "2.000.000,00"),
                        ],
                      ),
                    ),
                  ),
                ],
              ),
            ),
            _buildSection("Pengalaman Kerja", "Tambah Pengalaman Kerja"),
            _buildSection("Pendidikan", "Tambah Pendidikan"),
            _buildSection("Skill", "Tambah Skill"),
            _buildSection("CV", "Tambah CV"),
            _buildSection("Butuh Bantuan", "Tambah Pertanyaan"),
          ],
        ),
      ),
    );
  }

  Widget _buildStat(String title, String value) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: [
        Text(title, style: GoogleFonts.poppins(fontSize: 12, color: Colors.black54)),
        Text(value, style: GoogleFonts.poppins(fontSize: 16, fontWeight: FontWeight.bold)),
      ],
    );
  }

  Widget _buildSection(String title, String actionText) {
    return Padding(
      padding: EdgeInsets.symmetric(horizontal: 20, vertical: 10),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(title, style: GoogleFonts.poppins(fontSize: 14, fontWeight: FontWeight.bold)),
          TextButton.icon(
            onPressed: () {},
            icon: Icon(Icons.add, color: Colors.blue),
            label: Text(actionText, style: TextStyle(color: Colors.blue)),
          ),
        ],
      ),
    );
  }
}
