// import 'package:flutter/material.dart';
// import 'screens/home_page.dart';

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

import 'package:flutter/material.dart';
import 'screens/profil.dart'; // Pastikan path-nya sesuai struktur foldermu

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Profil App',
      theme: ThemeData(
        primarySwatch: Colors.purple,
      ),
      home: ProfilePage(), 
    );
  }
}


// import 'package:flutter/material.dart';
// import 'package:proyek_pa2/screens/form_daftar_kerja.dart';

// void main() {
//   runApp(MaterialApp(
//     debugShowCheckedModeBanner: false,
//     home: FormDaftarKerja(), 
//   ));
// }


// import 'package:flutter/material.dart';
// import 'screens/job_list_page.dart';

// void main() {
//   runApp(const MyApp());
// }

// class MyApp extends StatelessWidget {
//   const MyApp({super.key});

//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       debugShowCheckedModeBanner: false,
//       title: 'Job List App',
//       theme: ThemeData(
//         primarySwatch: Colors.purple,
//       ),
//       home: const JobListPage(),
//     );
//   }
// }

// import 'package:flutter/material.dart';
// import 'screens/validasi.dart';

// void main() {
//   runApp(MyApp());
// }

// class MyApp extends StatelessWidget {
//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       debugShowCheckedModeBanner: false,
//       title: 'Validasi Page',
//       theme: ThemeData(
//         primarySwatch: Colors.purple,
//       ),
//       home: ValidasiPage(),
//     );
//   }
// }

// class HomePage extends StatelessWidget {
//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//       appBar: AppBar(title: Text('Home')),
//       body: Center(
//         child: ElevatedButton(
//           onPressed: () {
//             Navigator.push(
//               context,
//               MaterialPageRoute(builder: (context) => ValidasiPage()),
//             );
//           },
//           child: Text('Buka Halaman Validasi'),
//         ),
//       ),
//     );
//   }
// }

// import 'package:flutter/material.dart';
// import 'screens/form_page.dart';

// void main() {
//   runApp(MyApp());
// }

// class MyApp extends StatelessWidget {
//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       debugShowCheckedModeBanner: false,
//       home: FormPage(
//        onJobAdded: (job) {}, // bisa kosong dulu, nanti diisi sesuai kebutuhan
//       ),
//     );
//   }
// }


// import 'package:flutter/material.dart';
// import 'screens/register_page.dart';

// void main() {
//   runApp(const MyApp());
// }

// class MyApp extends StatelessWidget {
//   const MyApp({super.key});

//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       debugShowCheckedModeBanner: false,
//       title: 'Gignego',
//       theme: ThemeData(
//         primarySwatch: Colors.blue,
//         fontFamily: 'Arial',
//       ),
//       home: const RegisterPage(),
//     );
//   }
// }


// import 'package:flutter/material.dart';
// import 'package:proyek_pa2/screens/create_password_page.dart';

// void main() {
//   runApp(const MyApp());
// }

// class MyApp extends StatelessWidget {
//   const MyApp({super.key});

//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       title: 'Gignego',
//       debugShowCheckedModeBanner: false,
//       theme: ThemeData(
//         primarySwatch: Colors.purple,
//         scaffoldBackgroundColor: Colors.white,
//         fontFamily: 'Arial', 
//       ),
//       home: const CreatePasswordPage(),
//     );
//   }
// }


// import 'package:flutter/material.dart';
// import 'package:proyek_pa2/screens/list_kerja.dart';

// void main() {
//   runApp(MyApp());
// }

// class MyApp extends StatelessWidget {
//   @override
//   Widget build(BuildContext context) {
//     return MaterialApp(
//       debugShowCheckedModeBanner: false,
//       title: 'Aplikasi Pekerjaan',
//       theme: ThemeData(
//         primarySwatch: Colors.purple,
//         fontFamily: 'Poppins', // jika kamu pakai font custom
//       ),
//       home: JobListPage(),
//     );
//   }
// }
