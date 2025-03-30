import 'package:flutter/material.dart';
import 'pages/daftar_pekerjaan.dart';  // Import halaman utama

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false, 
      title: 'Job App',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: DaftarPekerjaanPage(),  // Pakai halaman daftar pekerjaan sebagai home
    );
  }
}
