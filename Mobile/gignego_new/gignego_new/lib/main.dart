// import 'package:flutter/material.dart';
// import 'package:flutter_application/pages/profil/profil.dart'; 

// void main() {
//   runApp(MyApp());
// }

// class MyApp extends StatelessWidget {
//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       title: 'Profil App',
//       theme: ThemeData(
//         primarySwatch: Colors.purple,
//       ),
//       home: ProfilPage(), 
//     ); 
//   }
// }


// import 'package:flutter/material.dart';
// import 'package:flutter_application/pages/job//process_jobs_page.dart';
// import 'package:flutter_application/pages/job/job_list_page.dart';
// import 'package:flutter_application/pages/job/available_jobs_page.dart'; //harusnya ini login dluan sih nanti samsi aja

// void main() {
//   runApp(const MyApp());
// }

// class MyApp extends StatelessWidget {
//   const MyApp({super.key});

//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       title: 'Daftar Pekerjaan',
//       debugShowCheckedModeBanner: false,
//       theme: ThemeData(
//         fontFamily: 'Roboto',
//         primarySwatch: Colors.purple,
//         scaffoldBackgroundColor: const Color(0xFFF5F3FF),
//         appBarTheme: const AppBarTheme(
//           backgroundColor: Colors.transparent,
//           elevation: 0,
//           centerTitle: true,
//           iconTheme: IconThemeData(color: Colors.black),
//           titleTextStyle: TextStyle(
//             color: Colors.black,
//             fontWeight: FontWeight.bold,
//             fontSize: 20,
//           ),
//         ),
//       ),
//       initialRoute: '/',
//       routes: {
//         '/': (context) => const JobListPage(),
//         '/available': (context) => const AvailableJobsPage(),
//         '/process' : (context) => const ProcessJobsPage(), //harusnya ini login dluan sih nanti samsi aja
//         // tambahkan lebih banyak route di sini jika kamu punya halaman lain
//       },
//     );
//   }
// }



// import 'package:flutter/material.dart';
// import 'package:flutter_application/pages/home/home_page.dart';

// void main() {
//   runApp(MyApp());
// }

// class MyApp extends StatelessWidget {
//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       debugShowCheckedModeBanner: false,
//       home: HomePage(), 
//     );
//   }
// }






// import 'package:flutter/material.dart';
// import 'Services/auth/auth_gate.dart';
// import 'package:firebase_core/firebase_core.dart';
// import 'firebase_options.dart';


// void main() async {
//   WidgetsFlutterBinding.ensureInitialized();
//   await Firebase.initializeApp(options: DefaultFirebaseOptions.currentPlatform);
//   runApp(const MyApp());
// }

// class MyApp extends StatelessWidget {
//   const MyApp({super.key});

//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
      
//       debugShowCheckedModeBanner: false,
//       home: AuthGate(),
//     );
//   }
// }

// import 'package:flutter/material.dart';
// import 'package:flutter_application/pages/auth/login.dart';


// void main() {
//   runApp(const MyApp());
// }

// class MyApp extends StatelessWidget {
//   const MyApp({super.key});

//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       title: 'Gignego App',
//       debugShowCheckedModeBanner: false,
//       theme: ThemeData(
//         primarySwatch: Colors.purple,
//         scaffoldBackgroundColor: Colors.white,
//         ),
//       home: LoginPage(),
//     );
//   }
// }

<<<<<<< HEAD:Mobile/gignego_new/gignego_new/lib/main.dart
=======

// import 'package:flutter/material.dart';
// import 'pages/auth/register_page.dart'; 

// void main() {
//   runApp(MyApp());
// }

// class MyApp extends StatelessWidget {
//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       debugShowCheckedModeBanner: false,
//       title: 'GigNego',
//       theme: ThemeData(
//         primarySwatch: Colors.blue,
//       ),
//       home: RegisterPage(),
//     );
//   }
// }

>>>>>>> 7811c4cb8554265da3b35ab86c8b9bf62d1a06ad:Mobile/gignego_new/lib/main.dart
import 'package:flutter/material.dart';
import 'package:flutter_application/pages/activity/tampilan.dart'; 

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Aktivitas App',
      theme: ThemeData(
        primarySwatch: Colors.purple,
      ),
      home: AktivitasPekerjaanPage(),
    );
  }
}
