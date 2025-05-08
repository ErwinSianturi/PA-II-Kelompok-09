import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:intl/intl.dart';
import 'package:flutter_application/pages/profil/setingan.dart';
import 'package:flutter_application/pages/profil/tambah_pendidikan.dart';
import 'package:flutter_application/pages/profil/tambah_skill.dart';
import 'package:flutter_application/pages/profil/tambah_cv.dart';
import 'package:flutter_application/pages/profil/tambah_pertanyaan.dart';
import 'package:flutter_application/pages/profil/tambah_pengalaman.dart';
import 'package:flutter_application/pages/profil/edit_profil.dart';
import 'package:flutter_application/pages/home/home_page.dart';
import 'package:flutter_application/pages/profil/profile_provider.dart';

class ProfilPage extends StatefulWidget {
  const ProfilPage({Key? key}) : super(key: key);

  @override
  _ProfilPageState createState() => _ProfilPageState();
}

class _ProfilPageState extends State<ProfilPage> 

{
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      floatingActionButton: CustomFAB(
        onPressed: () {
          print("FAB ditekan");
        },
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      bottomNavigationBar: _buildBottomNavBar(context, 3), // 3 adalah index untuk Profil
      body: Consumer<ProfileProvider>(
        builder: (context, profileProvider, child) {
          if (profileProvider.isLoading) {
            return Center(child: CircularProgressIndicator());
          }

          if (profileProvider.error != null) {
            return Center(child: Text('Error: ${profileProvider.error}'));
          }

          final userProfile = profileProvider.userProfile;
          if (userProfile == null) {
            return Center(child: Text('Data profil tidak tersedia'));
          }

          // Format tanggal update
          String formattedDate = 'Last Update: ';
          try {
            DateTime lastUpdate = DateTime.parse(userProfile.lastUpdate);
            formattedDate += DateFormat('dd MMMM yyyy').format(lastUpdate);
          } catch (e) {
            formattedDate += userProfile.lastUpdate;
          }

          return SingleChildScrollView(
            child: Column(
              children: [
                Stack(
                  alignment: Alignment.topCenter,
                  children: [
                    Container(height: 200, color: Colors.white),
                    Container(
                      margin: EdgeInsets.only(top: 100, left: 20, right: 20),
                      padding: EdgeInsets.only(top: 10),
                      decoration: BoxDecoration(
                        gradient: LinearGradient(
                          colors: [
                            Color(0xFFAB74F1),
                            Color(0xFF7C4CB8),
                            Color(0xFF593785)
                          ],
                          begin: Alignment.topCenter,
                          end: Alignment.bottomCenter,
                        ),
                        borderRadius: BorderRadius.vertical(top: Radius.circular(30)),
                      ),
                      child: Padding(
                        padding: const EdgeInsets.all(20),
                        child: Column(
                          children: [
                            SizedBox(height: 40),
                            Text(
                              userProfile.name,
                              style: TextStyle(
                                  color: Colors.white,
                                  fontSize: 18,
                                  fontWeight: FontWeight.bold),
                            ),
                            Text("Profil Belum Lengkap",
                                style: TextStyle(color: Colors.white70, fontSize: 14)),
                            Text(formattedDate,
                                style: TextStyle(color: Colors.white70, fontSize: 12)),
                            SizedBox(height: 10),
                            ElevatedButton(
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(builder: (context) => EditProfilPage()),
                                ).then((result) {
                                  // Refresh data setelah kembali dari halaman edit
                                  if (result == true) {
                                    // Jika hasil true, artinya ada perubahan data
                                    Provider.of<ProfileProvider>(context, listen: false)
                                        .fetchUserProfile(18); // ID user
                                  }
                                });
                              },
                              style: ElevatedButton.styleFrom(
                                backgroundColor: Colors.transparent,
                                side: BorderSide(color: Colors.white),
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(20),
                                ),
                              ),
                              child: Text("Edit Profil", style: TextStyle(color: Colors.white)),
                            ),
                            SizedBox(height: 20),
                            Container(
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
                                      Expanded(
                                        child: Text("Penghasilan belum jatuh tempo akan cair dalam 2 hari setelah waktu kerja."),
                                      ),
                                    ],
                                  ),
                                ],
                              ),
                            ),
                            ProfileSection(
                              icon: Icons.business_center,
                              title: "Pengalaman Kerja",
                              buttonText: "Tambah Pengalaman Kerja",
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                   builder: (context) => AddWorkExperiencePage(userId: 18),
                                  ),
                                );
                              },
                            ),
                            ProfileSection(
                              icon: Icons.school,
                              title: "Pendidikan",
                              buttonText: "Tambah Pendidikan",
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(builder: (context) => TambahPendidikanPage()),
                                );
                              },
                            ),
                            ProfileSection(
                              icon: Icons.build,
                              title: "Skill",
                              buttonText: "Tambah Skill",
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(builder: (context) => TambahSkillPage()),
                                );
                              },
                            ),
                            ProfileSection(
                              icon: Icons.description,
                              title: "CV",
                              buttonText: "Tambah CV",
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(builder: (context) => TambahCVPage()),
                                );
                              },
                            ),
                            ProfileSection(
                              icon: Icons.help_outline,
                              title: "Butuh Bantuan",
                              buttonText: "Tambah Pertanyaan",
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(builder: (context) => TambahPertanyaanPage()),
                                );
                              },
                            ),
                            SizedBox(height: 20),
                          ],
                        ),
                      ),
                    ),
                    Positioned(
                      top: 50,
                      child: CircleAvatar(
                        radius: 50,
                        backgroundColor: Color(0xFF9E61EB),
                        child: CircleAvatar(
                          radius: 46,
                          backgroundImage: userProfile.photoUrl != null
                              ? NetworkImage(userProfile.photoUrl!)
                              : AssetImage("assets/profile.jpg") as ImageProvider,
                        ),
                      ),
                    ),
                    Positioned(
                      top: -20,
                      left: 20,
                      child: Image.asset(
                        "assets/gignego.png",
                        width: 150,
                        height: 150,
                      ),
                    ),
                    Positioned(
                      top: 30,
                      right: 20,
                      child: IconButton(
                        icon: Icon(Icons.settings, color: Color(0xFF054DC0)),
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => SettingPage()),
                          );
                        },
                      ),
                    ),
                  ],
                ),
              ],
            ),
          );
        },
      ),
    );
  }

  // Bottom Navigation Bar dengan indikator halaman aktif
  Widget _buildBottomNavBar(BuildContext context, int currentIndex) {
    return BottomAppBar(
      shape: CircularNotchedRectangle(),
      notchMargin: 8,
      child: Container(
        padding: EdgeInsets.symmetric(horizontal: 3, vertical: 0.5),
        height: 50,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceAround,
          children: [
            _buildNavItem(
              context,
              "assets/home.png",
              0,
              currentIndex,
              () {
                Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(builder: (context) => HomePage()),
                );
              },
            ),
            _buildNavItem(
              context,
              "assets/obrolan.png",
              1,
              currentIndex,
              () {
                // Navigasi ke halaman chat
              },
            ),
            _buildNavItem(
              context,
              "assets/aktivitas.png",
              2,
              currentIndex,
              () {
                // Navigasi ke halaman aktivitas
              },
            ),
            _buildNavItem(
              context,
              "assets/profil.png",
              3,
              currentIndex,
              () {
                // Sudah di halaman profil
              },
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildNavItem(BuildContext context, String iconPath, int index, int currentIndex, VoidCallback onPressed) {
    final bool isActive = currentIndex == index;
    
    return IconButton(
      icon: ColorFiltered(
        colorFilter: ColorFilter.mode(
          isActive ? Color(0xFF9E61EB) : Colors.black,
          BlendMode.srcIn,
        ),
        child: Image.asset(
          iconPath,
          width: 35,
          height: 35,
        ),
      ),
      onPressed: onPressed,
    );
  }
}

class ProfileSection extends StatelessWidget {
  final IconData icon;
  final String title;
  final String buttonText;
  final VoidCallback onPressed;

  const ProfileSection({
    Key? key,
    required this.icon,
    required this.title,
    required this.buttonText,
    required this.onPressed,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: EdgeInsets.symmetric(horizontal: 0, vertical: 5),
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
            onPressed: onPressed,
            icon: Icon(Icons.add, color: Color(0xFF054DC0)),
            label: Text(buttonText,
                style: TextStyle(color: Color(0xFF054DC0), fontWeight: FontWeight.bold)),
          ),
        ],
      ),
    );
  }
}

class CustomFAB extends StatelessWidget {
  final VoidCallback? onPressed;

  const CustomFAB({Key? key, this.onPressed}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return FloatingActionButton(
      onPressed: onPressed,
      backgroundColor: Colors.transparent,
      elevation: 0,
      highlightElevation: 0,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(100)),
      child: Image.asset(
        'assets/add.png',  
        width: 60,
        height: 60,
      ),
    );
  }
}
