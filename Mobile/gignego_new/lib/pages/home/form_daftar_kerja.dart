
import 'package:flutter/material.dart';

class TambahPengalamanKerjaPage extends StatefulWidget {
  @override
  _TambahPengalamanKerjaPageState createState() => _TambahPengalamanKerjaPageState();
}

class _TambahPengalamanKerjaPageState extends State<TambahPengalamanKerjaPage> {
  final _formKey = GlobalKey<FormState>();
  bool _masihBekerja = false;

  // Controllers
  final posisiController = TextEditingController();
  final perusahaanController = TextEditingController();
  final kotaController = TextEditingController();
  final deskripsiController = TextEditingController();

  // Dropdown values
  String? negara;
  String? tanggalMulai;
  String? tanggalBerakhir;
  String? fungsi;
  String? industri;
  String? level;
  String? tipe;

  bool get isFormValid {
    return posisiController.text.isNotEmpty &&
        perusahaanController.text.isNotEmpty &&
        negara != null &&
        kotaController.text.isNotEmpty &&
        tanggalMulai != null &&
        (_masihBekerja || tanggalBerakhir != null) &&
        fungsi != null &&
        industri != null &&
        level != null &&
        tipe != null &&
        deskripsiController.text.isNotEmpty;
  }

  void checkFormStatus() {
    setState(() {});
  }

  @override
  void dispose() {
    posisiController.dispose();
    perusahaanController.dispose();
    kotaController.dispose();
    deskripsiController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Tambah Pengalaman Kerja"),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Form(
          key: _formKey,
          onChanged: checkFormStatus,
          child: SingleChildScrollView(
            child: Column(
              children: [
                _buildTextField("Posisi Pekerjaan", posisiController),
                _buildTextField("Nama Perusahaan", perusahaanController),
                _buildDropdown("Negara", ["Indonesia", "Malaysia"], negara, (val) => setState(() => negara = val)),
                _buildTextField("Kota", kotaController),
                _buildDropdown("Tanggal Mulai", ["Januari 2024", "Februari 2024"], tanggalMulai, (val) => setState(() => tanggalMulai = val)),
                if (!_masihBekerja)
                  _buildDropdown("Tanggal Berakhir", ["Januari 2025", "Februari 2025"], tanggalBerakhir, (val) => setState(() => tanggalBerakhir = val)),
                Row(
                  children: [
                    Checkbox(
                      value: _masihBekerja,
                      onChanged: (val) {
                        setState(() {
                          _masihBekerja = val!;
                          if (_masihBekerja) tanggalBerakhir = null;
                        });
                      },
                    ),
                    Text("Saya masih bekerja di sini"),
                  ],
                ),
                _buildDropdown("Fungsi Pekerjaan", ["Administrasi", "IT", "Keuangan"], fungsi, (val) => setState(() => fungsi = val)),
                _buildDropdown("Industri Perusahaan", ["Universitas/Instansi Pendidikan", "Perusahaan Teknologi"], industri, (val) => setState(() => industri = val)),
                Row(
                  children: [
                    Expanded(child: _buildDropdown("Level Pekerjaan", ["Pemula/Staf", "Menengah"], level, (val) => setState(() => level = val))),
                    SizedBox(width: 10),
                    Expanded(child: _buildDropdown("Tipe Pekerjaan", ["Paruh Waktu", "Penuh Waktu"], tipe, (val) => setState(() => tipe = val))),
                  ],
                ),
                TextFormField(
                  controller: deskripsiController,
                  maxLines: 3,
                  maxLength: 1000,
                  decoration: InputDecoration(
                    labelText: "Deskripsi Pekerjaan",
                    hintText: "Tulis tugas dan tanggung jawab atau pencapaianmu di sini",
                  ),
                ),
                SizedBox(height: 20),
                Row(
                  children: [
                    Expanded(
                      child: OutlinedButton(
                        onPressed: () => Navigator.pop(context),
                        child: Text("Batal"),
                      ),
                    ),
                    SizedBox(width: 10),
                    Expanded(
                      child: ElevatedButton(
                        onPressed: isFormValid ? () {} : null,
                        style: ElevatedButton.styleFrom(
                          backgroundColor: isFormValid ? Colors.purple : Colors.grey[400],
                        ),
                        child: Text("Simpan"),
                      ),
                    ),
                  ],
                )
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildTextField(String label, TextEditingController controller) {
    return TextFormField(
      controller: controller,
      decoration: InputDecoration(labelText: label),
    );
  }

  Widget _buildDropdown(String label, List<String> items, String? value, void Function(String?) onChanged) {
    return DropdownButtonFormField<String>(
      value: value,
      decoration: InputDecoration(labelText: label),
      items: items.map((e) => DropdownMenuItem(value: e, child: Text(e))).toList(),
      onChanged: onChanged,
    );
  }
}
