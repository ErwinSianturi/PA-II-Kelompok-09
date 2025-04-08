import 'package:flutter/material.dart';

class ProfilPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      bottomNavigationBar: BottomNavBar(),
      body: SingleChildScrollView(
        child: Column(
          children: [
            Stack(
              alignment: Alignment.topCenter,
              children: [
                // Background putih
                Container(
                  height: 200,
                  color: Colors.white,
                ),
                // Rectangle besar dengan gradient
                Container(
                  margin: EdgeInsets.only(top: 100),
                  padding: EdgeInsets.only(top: 60),
                  decoration: BoxDecoration(
                    gradient: LinearGradient(
                      colors: [Color(0xFFAB74F1), Color(0xFF7C4CB8), Color(0xFF593785)],
                      begin: Alignment.topCenter,
                      end: Alignment.bottomCenter,
                    ),
                    borderRadius: BorderRadius.vertical(top: Radius.circular(30)),
                  ),
                  child: Column(
                    children: [
                      SizedBox(height: 40),
                      Text(
                        "Yenny Angelita Gurning",
                        style: TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.bold),
                      ),
                      Text(
                        "Profil Belum Lengkap",
                        style: TextStyle(color: Colors.white70, fontSize: 14),
                      ),
                      Text(
                        "Last Update: 20 Maret 2025",
                        style: TextStyle(color: Colors.white70, fontSize: 12),
                      ),
                      SizedBox(height: 10),
                      ElevatedButton(
                        onPressed: () {},
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.transparent,
                          side: BorderSide(color: Colors.white),
                          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
                        ),
                        child: Text("Edit Profil", style: TextStyle(color: Colors.white)),
                      ),
                      SizedBox(height: 20),
                      // Penghasilan Section
                      Container(
                        margin: EdgeInsets.symmetric(horizontal: 20),
                        padding: EdgeInsets.all(15),
                        decoration: BoxDecoration(
                          color: Colors.white,
                          borderRadius: BorderRadius.circular(15),
                          boxShadow: [BoxShadow(color: Colors.black12, blurRadius: 5)],
                        ),
                        child: Column(
                          children: [
                            Row(
                              mainAxisAlignment: MainAxisAlignment.spaceAround,
                              children: [
                                Column(
                                  children: [
                                    Text("Penghasilan Belum \nJatuh Tempo (Rp)", textAlign: TextAlign.center),
                                    SizedBox(height: 5),
                                    Text("50.000,00", style: TextStyle(fontWeight: FontWeight.bold)),
                                  ],
                                ),
                                Container(width: 1, height: 40, color: Colors.grey),
                                Column(
                                  children: [
                                    Text("Aset Penghasilan (Rp)", textAlign: TextAlign.center),
                                    SizedBox(height: 5),
                                    Text("2.000.000,00", style: TextStyle(fontWeight: FontWeight.bold)),
                                  ],
                                ),
                              ],
                            ),
                            SizedBox(height: 10),
                            Divider(color: Colors.grey),
                            Row(
                              children: [
                                Icon(Icons.info_outline, color: Colors.grey, size: 16),
                                SizedBox(width: 5),
                                Expanded(child: Text("Penghasilan belum jatuh tempo akan cair dalam 2 hari setelah waktu kerja")),
                              ],
                            ),
                          ],
                        ),
                      ),
                      SizedBox(height: 20),
                      ProfileSection(icon: Icons.work, title: "Pengalaman Kerja", buttonText: "Tambah Pengalaman Kerja"),
                      ProfileSection(icon: Icons.school, title: "Pendidikan", buttonText: "Tambah Pendidikan"),
                      ProfileSection(icon: Icons.star, title: "Skill", buttonText: "Tambah Skill"),
                      ProfileSection(icon: Icons.file_present, title: "CV", buttonText: "Tambah CV"),
                      ProfileSection(icon: Icons.help_outline, title: "Butuh Bantuan", buttonText: "Tambah Pertanyaan"),
                      SizedBox(height: 20),
                    ],
                  ),
                ),
                // Foto Profil (Naik ke atas)
                Positioned(
                  top: 50,
                  child: CircleAvatar(
                    radius: 50,
                    backgroundColor: Color(0xFF9E61EB),
                    child: CircleAvatar(
                      radius: 46,
                      backgroundImage: AssetImage("assets/profile.jpg"),
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

class ProfileSection extends StatelessWidget {
  final IconData icon;
  final String title;
  final String buttonText;

  ProfileSection({required this.icon, required this.title, required this.buttonText});

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: EdgeInsets.symmetric(horizontal: 20, vertical: 5),
      padding: EdgeInsets.all(10),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(15),
        boxShadow: [BoxShadow(color: Colors.black12, blurRadius: 5)],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Icon(icon, color: Color(0xFF054DC0)),
              SizedBox(width: 10),
              Expanded(child: Text(title, style: TextStyle(fontWeight: FontWeight.bold))),
              Icon(Icons.arrow_forward_ios, size: 16, color: Colors.grey),
            ],
          ),
          SizedBox(height: 5),
          TextButton.icon(
            onPressed: () {},
            icon: Icon(Icons.add, color: Color(0xFF054DC0)),
            label: Text(buttonText, style: TextStyle(color: Color(0xFF054DC0), fontWeight: FontWeight.bold)),
          ),
        ],
      ),
    );
  }
}

class BottomNavBar extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return BottomAppBar(
      shape: CircularNotchedRectangle(),
      notchMargin: 8,
      child: Container(
        padding: EdgeInsets.symmetric(vertical: 10),
        height: 70,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceAround,
          children: [
            IconButton(icon: Image.asset("assets/home.png", width: 30, height: 30), onPressed: () {}),
            IconButton(icon: Image.asset("assets/obrolan.png", width: 30, height: 30), onPressed: () {}),
            IconButton(icon: Image.asset("assets/aktivitas.png", width: 30, height: 30), onPressed: () {}),
            IconButton(icon: Image.asset("assets/profil.png", width: 30, height: 30), onPressed: () {}),
          ],
        ),
      ),
    );
  }
}