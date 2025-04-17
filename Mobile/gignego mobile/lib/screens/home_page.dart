import 'dart:io';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:proyek_pa2/screens/form_page.dart';
import 'package:proyek_pa2/models/job.dart';
import 'package:proyek_pa2/screens/job_list_page.dart';
import 'package:proyek_pa2/screens/profil.dart';


void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: HomePage(),
    );
  }
}

class HomePage extends StatefulWidget {
  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  List<Job> pekerjaan = [];
  Job? pekerjaanBaru;
  bool isPressed = false;

  void tambahPekerjaan(Job job) {
    setState(() {
      pekerjaan.add(job);
      pekerjaanBaru = job;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      backgroundColor: Colors.white,
      bottomNavigationBar: BottomNavBar(),
      floatingActionButton: FloatingActionButton(
  onPressed: () {
    print('Navigasi ke FormPage');
    Navigator.push(
      context,
      MaterialPageRoute(
        builder: (context) => FormPage(onJobAdded: tambahPekerjaan),
      ),
    );
  },
  backgroundColor: Colors.transparent,
  elevation: 0,
  highlightElevation: 0,
  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(100)),
  child: Image.asset(
    'assets/images/add.png',
    width: 60,
    height: 60,
  ),
),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      body: SafeArea(
        child: SingleChildScrollView(
          physics: BouncingScrollPhysics(),
          child: Padding(
            padding: EdgeInsets.only(bottom: 100),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                _buildHeader(),
                _buildCategorySection(context),
                _buildJobSuggestion(),
                if (pekerjaanBaru != null) _buildNewJobNotification(context),
              ],
            ),
          ),
        ),
      ),
    );
  }

Widget _buildHeader() {
  return Stack(
    clipBehavior: Clip.none,
    children: [
      Container(
        width: double.infinity,
        padding: EdgeInsets.only(top: 50, bottom: 80),
        decoration: BoxDecoration(
          borderRadius: BorderRadius.only(
            bottomLeft: Radius.circular(30),
            bottomRight: Radius.circular(30),
          ),
          gradient: LinearGradient(
            colors: [
              Colors.blue.shade900,
              Colors.greenAccent.shade400,
              Colors.blue.shade900,
            ],
            stops: [0.0, 0.6, 1.0],
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
          ),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Align(
              alignment: Alignment.centerLeft, 
              child: Padding(
                padding: EdgeInsets.only(left: 60), 
                child: Image.asset(
                  'assets/images/Gig.png',
                  height: 45,
                  fit: BoxFit.contain,
                ),
              ),
            ),
            SizedBox(height: 5),
            Align(
              alignment: Alignment.centerLeft, 
              child: Padding(
                padding: EdgeInsets.only(left: 85),
                child: Text(
                  "kerja singkat deal cepat",
                  style: GoogleFonts.poppins(
                    fontSize: 18,
                    color: Colors.white,
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
      Positioned(
        left: 20,
        right: 20,
        bottom: -40,
        child: Container(
          padding: EdgeInsets.all(16),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(12),
            boxShadow: [
              BoxShadow(
                color: Colors.grey.withOpacity(0.1),
                blurRadius: 8,
                spreadRadius: 2,
              ),
            ],
          ),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
            children: [
              _buildActionItem("assets/images/Piala.png", "Ranking", true),
              _buildActionItem("assets/images/His.png", "History", true),
              _buildActionItem("assets/images/Chat.png", "Chat", true),
            ],
          ),
        ),
      ),
    ],
  );
}

  Widget _buildActionItem(dynamic icon, String label, bool isImage) {
    return Column(
      children: [
        CircleAvatar(
          backgroundColor: Colors.purple.shade50,
          radius: 24,
          child: isImage
              ? Image.asset(
                  icon as String,
                  width: 28,
                  height: 28,
                  fit: BoxFit.contain,
                  errorBuilder: (context, error, stackTrace) {
                    return Icon(Icons.broken_image, size: 28, color: Colors.red);
                  },
                )
              : Icon(icon as IconData, color: Colors.purple, size: 28),
        ),
        SizedBox(height: 6),
        Text(label, style: GoogleFonts.poppins(fontSize: 14)),
      ],
    );
  }

  Widget _buildCategorySection(BuildContext context) {
    List<Map<String, dynamic>> categories = [
      {"icon": "assets/images/Kebersihan.png", "label": "Kebersihan", "isImage": true},
      {"icon": "assets/images/Perbaikan.png", "label": "Perbaikan Rumah", "isImage": true},
      {"icon": "assets/images/Kendaraan.png", "label": "Perbaikan Kendaraan", "isImage": true},
      {"icon": "assets/images/Elektronik.png", "label": "Perbaikan Elektronik", "isImage": true},
      {"icon": "assets/images/Tutor.png", "label": "Tutor", "isImage": true},
      {"icon": "assets/images/Rumah.png", "label": "Rumah Tangga", "isImage": true},
      {"icon": "assets/images/Fotografi.png", "label": "Fotografi & Videografi", "isImage": true},
      {"icon": "assets/images/Lain.png", "label": "Lainnya", "isImage": true},
    ];

    return Padding(
      padding: const EdgeInsets.only(left: 1.5, right: 1.5, bottom: 10),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          SizedBox(height: 10),
          Padding(
            padding: const EdgeInsets.only(top: 50.0, left: 10, right: 16),
            child: Text(
              "Kategori",
              style: GoogleFonts.poppins(fontSize: 18, fontWeight: FontWeight.bold),
            ),
          ),
          SizedBox(height: 10),
          GridView.builder(
            padding: EdgeInsets.only(top: 5, bottom: 10, left: 5, right: 10),
            shrinkWrap: true,
            physics: NeverScrollableScrollPhysics(),
            gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
              crossAxisCount: 4,
              crossAxisSpacing: 3,
              mainAxisSpacing: 3,
              childAspectRatio: 0.85,
            ),
            itemCount: categories.length,
            itemBuilder: (context, index) {
              return GestureDetector(
                onTap: () {
                  print('Navigasi ke JobListPage: ${categories[index]["label"]}');
                  final pekerjaanKategori = pekerjaan
                      .where((job) =>
                          job.kategori == categories[index]["label"] &&
                          job.status == 'Tersedia')
                      .toList();
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => JobListPage(
                        job: pekerjaanKategori,
                        selectedCategory: categories[index]["label"],
                        showNotification: false,
                      ),
                    ),
                  );
                },
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Container(
                      width: 70,
                      height: 70,
                      decoration: BoxDecoration(
                        color: Colors.purple.shade50,
                        borderRadius: BorderRadius.circular(12),
                      ),
                      alignment: Alignment.center,
                      child: Image.asset(
                        categories[index]["icon"],
                        width: 35,
                        height: 35,
                        fit: BoxFit.contain,
                      ),
                    ),
                    SizedBox(height: 4),
                    SizedBox(
                      width: 70,
                      height: 20,
                      child: Text(
                        categories[index]["label"],
                        style: GoogleFonts.poppins(fontSize: 12),
                        textAlign: TextAlign.center,
                        overflow: TextOverflow.ellipsis,
                      ),
                    ),
                  ],
                ),
              );
            },
          ),
        ],
      ),
    );
  }

  Widget _buildJobSuggestion() {
    return Padding(
      padding: const EdgeInsets.all(16.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text(
                "Saran Kerja",
                style: GoogleFonts.poppins(fontSize: 18, fontWeight: FontWeight.bold),
              ),
              Text(
                "Selengkapnya",
                style: GoogleFonts.poppins(color: Colors.blue),
              ),
            ],
          ),
          SizedBox(height: 12),
          Container(
            padding: EdgeInsets.all(16),
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(16),
              gradient: LinearGradient(
                colors: [
                  Color(0xFF7321DA),
                  Color(0xFFAD7E80),
                  Color(0xFF3A42D2)
                ],
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
              ),
            ),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  "Mengecat Rumah",
                  style: GoogleFonts.poppins(
                    fontSize: 16,
                    fontWeight: FontWeight.bold,
                    color: Colors.white,
                  ),
                ),
                SizedBox(height: 4),
                Text(
                  '"Suka bekerja di luar ruangan?" kami mencari tenaga pengecatan rumah untuk membantu dalam renovasi',
                  style: GoogleFonts.poppins(fontSize: 14, color: Colors.white),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildNewJobNotification(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(16),
      child: GestureDetector(
        onTap: () {
          if (pekerjaanBaru != null) {
            print('Navigasi ke detail pekerjaan baru: ${pekerjaanBaru!.judul}');
            Navigator.push(
              context,
              MaterialPageRoute(
                builder: (context) => JobListPage(
                  job: [pekerjaanBaru!],
                  selectedCategory: pekerjaanBaru!.kategori,
                  showNotification: true,
                ),
              ),
            );
          }
        },
        child: Card(
          elevation: 4,
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
          child: Padding(
            padding: const EdgeInsets.all(16),
            child: Row(
              children: [
                ClipRRect(
                  borderRadius: BorderRadius.circular(8),
                  child: Image.file(
                    File(pekerjaanBaru!.gambar),
                    width: 60,
                    height: 60,
                    fit: BoxFit.cover,
                    errorBuilder: (context, error, stackTrace) =>
                        Icon(Icons.image, size: 60),
                  ),
                ),
                SizedBox(width: 16),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        "Pekerjaan Baru: ${pekerjaanBaru!.judul}",
                        style: GoogleFonts.poppins(
                          fontSize: 16,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      SizedBox(height: 4),
                      Text(
                        "Kategori: ${pekerjaanBaru!.kategori}",
                        style: GoogleFonts.poppins(fontSize: 14),
                      ),
                      Text(
                        "Lihat detail pekerjaan baru Anda!",
                        style: GoogleFonts.poppins(
                          fontSize: 12,
                          color: Colors.grey,
                        ),
                      ),
                    ],
                  ),
                ),
                Icon(Icons.arrow_forward_ios, size: 16),
              ],
            ),
          ),
        ),
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
        padding: EdgeInsets.symmetric(horizontal: 3, vertical: 0.5),
        height: 50,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceAround,
          children: [
            IconButton(
              icon: Image.asset("assets/images/Home.png", width: 35, height: 35),
              onPressed: () {},
            ),
            IconButton(
              icon: Image.asset("assets/images/Obrolan.png", width: 35, height: 35),
              onPressed: () {},
            ),
            IconButton(
              icon: Image.asset("assets/images/Aktivitas.png", width: 35, height: 35),
              onPressed: () {},
            ),
            IconButton(
              icon: Image.asset("assets/images/Profil.png", width: 35, height: 35),
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => ProfilePage()),
                );
              },
            ),
          ],
        ),
      ),
    );
  }
}
