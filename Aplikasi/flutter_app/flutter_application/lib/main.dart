import 'package:flutter/material.dart';
import 'package:flutter_application/pages/process_jobs_page.dart';
import 'pages/job_list_page.dart';
import 'pages/available_jobs_page.dart'; // import halaman lain

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Daftar Pekerjaan',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        fontFamily: 'Roboto',
        primarySwatch: Colors.purple,
        scaffoldBackgroundColor: const Color(0xFFF5F3FF),
        appBarTheme: const AppBarTheme(
          backgroundColor: Colors.transparent,
          elevation: 0,
          centerTitle: true,
          iconTheme: IconThemeData(color: Colors.black),
          titleTextStyle: TextStyle(
            color: Colors.black,
            fontWeight: FontWeight.bold,
            fontSize: 20,
          ),
        ),
      ),
      initialRoute: '/',
      routes: {
        '/': (context) => const JobListPage(),
        '/available': (context) => const AvailableJobsPage(),
        '/process' : (context) => const ProcessJobsPage(),
        // tambahkan lebih banyak route di sini jika kamu punya halaman lain
      },
    );
  }
}
