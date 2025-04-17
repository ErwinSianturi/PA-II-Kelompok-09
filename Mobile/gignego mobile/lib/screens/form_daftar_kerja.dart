import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: FormDaftarKerja(),
    );
  }
}

class FormDaftarKerja extends StatefulWidget {
  @override
  _FormDaftarKerja createState() => _FormDaftarKerja();
}

class _FormDaftarKerja extends State<FormDaftarKerja> {
  final _formKey = GlobalKey<FormState>();
  bool _agreeToTerms = false;

  @override
Widget build(BuildContext context) {
  return Scaffold(
    backgroundColor: Colors.grey[900],
    body: Container(
      width: double.infinity,
      height: MediaQuery.of(context).size.height, 
      padding: const EdgeInsets.fromLTRB(16, 50, 16, 16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(16),
      ),
      child: SingleChildScrollView(
        child: Form(
          key: _formKey,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const Text(
                'Daftar Pekerjaan apa hari ini?',
                style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
              ),
              const SizedBox(height: 16),

              buildTextField('Nama'),
              buildTextField('No HP/WhatsApp'),
              buildTextField('Lokasi'),
              buildTextField('Waktu Pengerjaan', icon: Icons.access_time),
              buildTextField('Pengalaman'),
              const SizedBox(height: 4),
              
              buildTextField('Catatan Tambahan', optional: true),

              SizedBox(height: 20),
              CheckboxListTile(
                controlAffinity: ListTileControlAffinity.leading, 
                title: const Text('Saya bersedia mengikuti syarat dan ketentuan pekerjaan ini'),
                value: _agreeToTerms,
                onChanged: (value) {
                  setState(() {
                    _agreeToTerms = value!;
                  });
                },
              ),

              SizedBox(height: 20),
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.purple,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(16),
                    ),
                    padding: EdgeInsets.symmetric(vertical: 14),
                  ),
                  onPressed: () {
                    if (_formKey.currentState!.validate() && _agreeToTerms) {
                      // Proses form
                    }
                  },
                  child: const Text('SUBMIT', style: TextStyle(color: Colors.white, fontSize: 16)),
                ),
              ),
            ],
          ),
        ),
      ),
    ),
  );
}

  Widget buildTextField(String label, {IconData? icon, bool optional = false}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            label,
            style: TextStyle(fontWeight: FontWeight.bold, color:  Color(0xFF33147A)),
          ),
          const SizedBox(height: 4),
          TextFormField(
            decoration: InputDecoration(
              border: OutlineInputBorder(
                borderRadius: BorderRadius.circular(8),
              ),
              suffixIcon: icon != null ? Icon(icon) : null,
              filled: true,
              fillColor: Colors.grey[200],
            ),
            validator: (value) {
              if (!optional && (value == null || value.isEmpty)) {
                return 'Field tidak boleh kosong';
              }
              return null;
            },
          ),
        ],
      ),
    );
  }
}
