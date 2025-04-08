import 'package:flutter/material.dart';

class EditProfilPage extends StatefulWidget {
  @override
  _EditProfilPageState createState() => _EditProfilPageState();
}

class _EditProfilPageState extends State<EditProfilPage> {
  final _formKey = GlobalKey<FormState>();
  TextEditingController tanggalController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: SingleChildScrollView(
          padding: EdgeInsets.all(20),
          child: Column(
            children: [
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text("Cancel", style: TextStyle(color: Colors.grey)),
                  Text("Edit Profil", style: TextStyle(fontWeight: FontWeight.bold)),
                  Text("GIGNEGO", style: TextStyle(color: Color(0xFF7C4CB8), fontWeight: FontWeight.bold)),
                ],
              ),
              SizedBox(height: 20),
              Stack(
                alignment: Alignment.bottomRight,
                children: [
                  CircleAvatar(
                    radius: 60,
                    backgroundImage: AssetImage("assets/profile.jpg"),
                  ),
                  CircleAvatar(
                    backgroundColor: Colors.white,
                    radius: 16,
                    child: Icon(Icons.edit, color: Color(0xFF7C4CB8), size: 18),
                  )
                ],
              ),
              SizedBox(height: 20),
              Form(
                key: _formKey,
                child: Column(
                  children: [
                    buildTextField("Nama"),
                    buildTextField("Email"),
                    buildTextField("Alamat"),
                    buildTextField("Pekerjaan", isDropdown: true),
                    buildDatePicker("Tanggal Lahir*"),
                  ],
                ),
              ),
              SizedBox(height: 30),
              ElevatedButton(
                onPressed: () {},
                style: ElevatedButton.styleFrom(
                  backgroundColor: Color(0xFFBB86FC),
                  minimumSize: Size(double.infinity, 45),
                  shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(5)),
                ),
                child: Text("Simpan", style: TextStyle(fontWeight: FontWeight.bold)),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget buildTextField(String label, {bool isDropdown = false}) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 20),
      child: isDropdown
          ? DropdownButtonFormField<String>(
              decoration: InputDecoration(
                labelText: label,
                labelStyle: TextStyle(color: Colors.grey),
                enabledBorder: UnderlineInputBorder(
                  borderSide: BorderSide(color: Color(0xFF7C4CB8)),
                ),
              ),
              items: ["Freelancer", "Mahasiswa", "Pekerja Tetap"]
                  .map((job) => DropdownMenuItem(value: job, child: Text(job)))
                  .toList(),
              onChanged: (value) {},
            )
          : TextFormField(
              decoration: InputDecoration(
                labelText: label,
                labelStyle: TextStyle(color: Colors.grey),
                enabledBorder: UnderlineInputBorder(
                  borderSide: BorderSide(color: Color(0xFF7C4CB8)),
                ),
              ),
            ),
    );
  }

  Widget buildDatePicker(String label) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 20),
      child: TextFormField(
        controller: tanggalController,
        readOnly: true,
        decoration: InputDecoration(
          labelText: label,
          suffixIcon: Icon(Icons.calendar_today),
          border: OutlineInputBorder(
            borderSide: BorderSide(color: Color(0xFF7C4CB8)),
            borderRadius: BorderRadius.circular(5),
          ),
        ),
        onTap: () async {
          DateTime? pickedDate = await showDatePicker(
            context: context,
            initialDate: DateTime.now(),
            firstDate: DateTime(1900),
            lastDate: DateTime(2100),
          );
          if (pickedDate != null) {
            tanggalController.text =
                "${pickedDate.day}/${pickedDate.month}/${pickedDate.year}";
          }
        },
      ),
    );
  }
}