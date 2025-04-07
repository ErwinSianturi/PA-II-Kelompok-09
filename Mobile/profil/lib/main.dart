import 'package:flutter/material.dart';
import 'profil.dart'; // Ensure proper import

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
      home: ProfilPage(), // Adjust according to the actual class
    ); 
  }
}