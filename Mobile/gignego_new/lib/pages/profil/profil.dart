import 'package:flutter/material.dart';
import 'package:flutter_application/pages/profil/edit_profil.dart';
import 'package:flutter_application/pages/profil/setingan.dart';
import 'package:flutter_application/pages/profil/tambah_pengalaman.dart';
import 'package:flutter_application/pages/profil/tambah_pendidikan.dart';
import 'package:flutter_application/pages/profil/tambah_skill.dart';
import 'package:flutter_application/pages/profil/tambah_cv.dart';
import 'package:flutter_application/pages/profil/tambah_pertanyaan.dart';

class ProfilPage extends StatefulWidget {
  @override
  _ProfilPageState createState() => _ProfilPageState();
}
class _ProfilPageState extends State<ProfilPage> {
<<<<<<< Updated upstream
=======
  List<dynamic> educations = [];
  bool isLoadingEducations = false;
  String? educationError;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      _loadEducations();
    });
  }

  Future<void> _loadEducations() async {
    final userProfile = Provider.of<ProfileProvider>(context, listen: false).userProfile;
    if (userProfile == null) return;

    setState(() {
      isLoadingEducations = true;
      educationError = null;
    });

    try {
      final response = await http.get(
        Uri.parse('http://10.0.2.2:8080/user/${userProfile.id}/educations'),
        headers: {'Content-Type': 'application/json'},
      );

      setState(() {
        isLoadingEducations = false;
      });

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        setState(() {
          educations = data['data'] ?? [];
        });
      } else {
        setState(() {
          educationError = 'Gagal memuat data pendidikan';
        });
      }
    } catch (e) {
      setState(() {
        isLoadingEducations = false;
        educationError = 'Terjadi kesalahan: $e';
      });
    }
  }

>>>>>>> Stashed changes
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color.fromARGB(255, 255, 255, 255),
      floatingActionButton: CustomFAB(),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
<<<<<<< Updated upstream
      bottomNavigationBar: BottomNavBar(),
      body: SingleChildScrollView(
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
                    borderRadius:
                        BorderRadius.vertical(top: Radius.circular(30)),
                  ),
                  child: Padding(
                    padding: const EdgeInsets.all(20),
                    child: Column(
                      children: [
                        SizedBox(height: 40),
                        Text("Yenny Angelita Gurning",
                            style: TextStyle(
=======
      bottomNavigationBar: _buildBottomNavBar(context, 3), 
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
                                  if (result == true) {
                                    Provider.of<ProfileProvider>(context, listen: false)
                                        .fetchUserProfile(userProfile.id ?? 18); 
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
>>>>>>> Stashed changes
                                color: Colors.white,
                                fontSize: 18,
                                fontWeight: FontWeight.bold)),
                        Text("Profil Belum Lengkap",
                            style:
                                TextStyle(color: Colors.white70, fontSize: 14)),
                        Text("Last Update: 20 Maret 2025",
                            style:
                                TextStyle(color: Colors.white70, fontSize: 12)),
                        SizedBox(height: 10),
                        ElevatedButton(
                          onPressed: () {
                            Navigator.push(
                              context,
                              MaterialPageRoute(
                                  builder: (context) => EditProfilPage()),
                            );
                          },
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Colors.transparent,
                            side: BorderSide(color: Colors.white),
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(20),
                            ),
                          ),
                          child: Text("Edit Profil",
                              style: TextStyle(color: Colors.white)),
                        ),
                        SizedBox(height: 20),
                        Container(
                          padding: EdgeInsets.all(15),
                          decoration: BoxDecoration(
                            color: Colors.white,
                            borderRadius: BorderRadius.circular(15),
                            boxShadow: [
                              BoxShadow(color: Colors.black12, blurRadius: 5)
                            ],
                          ),
                          child: Column(
                            children: [
                              Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceAround,
                                children: [
                                  Column(
                                    children: [
                                      Text(
                                          "Penghasilan Belum \nJatuh Tempo (Rp)",
                                          textAlign: TextAlign.center),
                                      SizedBox(height: 5),
                                      Text("50.000,00",
                                          style: TextStyle(
                                              fontWeight: FontWeight.bold)),
                                    ],
                                  ),
                                  Container(
                                      width: 1, height: 40, color: Colors.grey),
                                  Column(
                                    children: [
                                      Text("Aset Penghasilan (Rp)",
                                          textAlign: TextAlign.center),
                                      SizedBox(height: 5),
                                      Text("2.000.000,00",
                                          style: TextStyle(
                                              fontWeight: FontWeight.bold)),
                                    ],
                                  ),
                                ],
                              ),
<<<<<<< Updated upstream
                              SizedBox(height: 10),
                              Divider(color: Colors.grey),
                              Row(
                                children: [
                                  Icon(Icons.info_outline,
                                      color: Colors.grey, size: 16),
                                  SizedBox(width: 5),
                                  Expanded(
                                      child: Text(
                                          "Penghasilan belum jatuh tempo akan cair dalam 2 hari setelah waktu kerja")),
=======
                            ),
                            ProfileSection(
                              icon: Icons.business_center,
                              title: "Pengalaman Kerja",
                              buttonText: "Tambah Pengalaman Kerja",
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                   builder: (context) => AddWorkExperiencePage(userId: userProfile.id ?? 18),
                                  ),
                                );
                              },
                            ),
                            
                            Container(
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
                                      Icon(Icons.school, color: Color(0xFF054DC0)),
                                      SizedBox(width: 10),
                                      Expanded(child: Text("Pendidikan", style: TextStyle(fontWeight: FontWeight.bold))),
                                      Icon(Icons.arrow_forward_ios, size: 16, color: Colors.grey),
                                    ],
                                  ),
                                  
                                  if (isLoadingEducations)
                                    Padding(
                                      padding: const EdgeInsets.all(8.0),
                                      child: Center(child: CircularProgressIndicator(strokeWidth: 2)),
                                    )
                                  else if (educationError != null)
                                    Padding(
                                      padding: const EdgeInsets.all(8.0),
                                      child: Text(educationError!, style: TextStyle(color: Colors.red)),
                                    )
                                  else if (educations.isEmpty)
                                    Padding(
                                      padding: const EdgeInsets.all(8.0),
                                      child: Text("Belum ada data pendidikan", style: TextStyle(fontStyle: FontStyle.italic)),
                                    )
                                  else
                                    ListView.builder(
                                      shrinkWrap: true,
                                      physics: NeverScrollableScrollPhysics(),
                                      itemCount: educations.length,
                                      itemBuilder: (context, index) {
                                        final education = educations[index];
                                        return ListTile(
                                          contentPadding: EdgeInsets.symmetric(horizontal: 8, vertical: 0),
                                          title: Text(education['institution'] ?? '', 
                                            style: TextStyle(fontWeight: FontWeight.bold)),
                                          subtitle: Text('${education['level'] ?? ''} - ${education['major'] ?? ''}'),
                                          trailing: IconButton(
                                            icon: Icon(Icons.delete, color: Colors.red),
                                            onPressed: () => _deleteEducation(education['id']),
                                          ),
                                        );
                                      },
                                    ),
                                  
                                  TextButton.icon(
                                    onPressed: () {
                                      Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                          builder: (context) => TambahPendidikanPage(
                                            userId: userProfile.id ?? 18,
                                          ),
                                        ),
                                      ).then((result) {
                                        if (result == true) {
                                          _loadEducations(); 
                                        }
                                      });
                                    },
                                    icon: Icon(Icons.add, color: Color(0xFF054DC0)),
                                    label: Text("Tambah Pendidikan",
                                        style: TextStyle(color: Color(0xFF054DC0), fontWeight: FontWeight.bold)),
                                  ),
>>>>>>> Stashed changes
                                ],
                              ),
                            ],
                          ),
                        ),
                        SizedBox(height: 20),
                        ProfileSection(
                            icon: Icons.business_center,
                            title: "Pengalaman Kerja",
                            buttonText: "Tambah Pengalaman Kerja",
                            onPressed: () {
                              Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) =>
                                        TambahPengalamanPage()),
                              );
                            }),
                        ProfileSection(
                            icon: Icons.school,
                            title: "Pendidikan",
                            buttonText: "Tambah Pendidikan",
                            onPressed: () {
                              Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) => TambahPendidikanPage()),
                              );
                            }),
                        ProfileSection(
                            icon: Icons.build,
                            title: "Skill",
                            buttonText: "Tambah Skill",
                            onPressed: () {
                              Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) => TambahSkillPage()),
                              );
                            }),
                        ProfileSection(
                            icon: Icons.description,
                            title: "CV",
                            buttonText: "Tambah CV",
                            onPressed: () {
                              Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) => TambahCVPage()),
                              );
                            }),
                        ProfileSection(
                            icon: Icons.help_outline,
                            title: "Butuh Bantuan",
                            buttonText: "Tambah Pertanyaan",
                            onPressed: () {
                              Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) =>
                                        TambahPertanyaanPage()),
                              );
                            }),
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
                      backgroundImage: AssetImage("assets/profile.jpg"),
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
                    icon: Icon(Icons.settings, color: const Color(0xFF054DC0)),
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
<<<<<<< Updated upstream
=======
          );
        },
      ),
    );
  }

  Future<void> _deleteEducation(int id) async {
    bool confirm = await showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: Text('Konfirmasi'),
        content: Text('Apakah Anda yakin ingin menghapus data pendidikan ini?'),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context, false),
            child: Text('Batal'),
          ),
          TextButton(
            onPressed: () => Navigator.pop(context, true),
            child: Text('Hapus', style: TextStyle(color: Colors.red)),
          ),
        ],
      ),
    ) ?? false;

    if (!confirm) return;

    try {
      final response = await http.delete(
        Uri.parse('http://10.0.2.2:8080/education/$id'),
        headers: {'Content-Type': 'application/json'},
      );

      if (response.statusCode == 200) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Data pendidikan berhasil dihapus')),
        );
        _loadEducations(); 
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Gagal menghapus data pendidikan')),
        );
      }
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Terjadi kesalahan: $e')),
      );
    }
  }

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

              },
            ),
            _buildNavItem(
              context,
              "assets/aktivitas.png",
              2,
              currentIndex,
              () {
              },
            ),
            _buildNavItem(
              context,
              "assets/profil.png",
              3,
              currentIndex,
              () {
              },
            ),
>>>>>>> Stashed changes
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
  final VoidCallback onPressed;

  const ProfileSection({
    required this.icon,
    required this.title,
    required this.buttonText,
    required this.onPressed,
  });

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
              Expanded(
                  child: Text(title,
                      style: TextStyle(fontWeight: FontWeight.bold))),
              Icon(Icons.arrow_forward_ios, size: 16, color: Colors.grey),
            ],
          ),
          SizedBox(height: 5),
          TextButton.icon(
            onPressed: onPressed,
            icon: Icon(Icons.add, color: Color(0xFF054DC0)),
            label: Text(buttonText,
                style: TextStyle(
                    color: Color(0xFF054DC0), fontWeight: FontWeight.bold)),
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
            IconButton(
                icon: Image.asset("assets/home.png", width: 30, height: 30),
                onPressed: () {}),
            IconButton(
                icon: Image.asset("assets/obrolan.png", width: 30, height: 30),
                onPressed: () {}),
            SizedBox(width: 40),
            IconButton(
                icon:
                    Image.asset("assets/aktivitas.png", width: 30, height: 30),
                onPressed: () {}),
            IconButton(
                icon: Image.asset("assets/profil.png", width: 30, height: 30),
                onPressed: () {}),
          ],
        ),
      ),
    );
  }
}

class CustomFAB extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Container(
      width: 70,
      height: 70,
      decoration: BoxDecoration(
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
      child: Center(
        child: Container(
          width: 60,
          height: 60,
          decoration: BoxDecoration(
            color: Colors.white,
            shape: BoxShape.circle,
          ),
          child: Center(
            child: Icon(Icons.add, color: Colors.black, size: 30),
          ),
        ),
      ),
    );
  }
}
