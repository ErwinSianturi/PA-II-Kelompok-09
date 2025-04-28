import 'package:flutter/material.dart';

class PendaftaranPekerjaanPage extends StatefulWidget {
  const PendaftaranPekerjaanPage({super.key});

  @override
  State<PendaftaranPekerjaanPage> createState() => _PendaftaranPekerjaanPageState();
}

class _PendaftaranPekerjaanPageState extends State<PendaftaranPekerjaanPage> {
  final TextEditingController _alasanController = TextEditingController();
  final TextEditingController _cocokController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Pendaftaran Pekerjaan"),
        backgroundColor: Colors.deepPurple,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Title and description for job details
              const Text(
                "Pekerjaan: Kebersihan Lapangan",
                style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold, color: Colors.deepPurple),
              ),
              const SizedBox(height: 10),
              const Text(
                "Harga Jasa: Rp.20,000",
                style: TextStyle(fontSize: 16, color: Colors.black87),
              ),
              const SizedBox(height: 5),
              const Text(
                "Waktu Jasa: 4 jam",
                style: TextStyle(fontSize: 16, color: Colors.black87),
              ),
              const SizedBox(height: 24),

              // Input fields for "Alasan Anda Memilih Pekerjaan Ini"
              TextField(
                controller: _alasanController,
                maxLines: 4,
                decoration: InputDecoration(
                  labelText: "Alasan Anda Memilih Pekerjaan Ini",
                  hintText: "Tuliskan alasan Anda...",
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(12),
                    borderSide: const BorderSide(color: Colors.deepPurple, width: 2),
                  ),
                  contentPadding: const EdgeInsets.all(16),
                ),
              ),
              const SizedBox(height: 16),

              // Input fields for "Alasan Anda Cocok untuk Pekerjaan Ini"
              TextField(
                controller: _cocokController,
                maxLines: 4,
                decoration: InputDecoration(
                  labelText: "Alasan Anda Cocok untuk Pekerjaan Ini",
                  hintText: "Jelaskan mengapa Anda cocok...",
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(12),
                    borderSide: const BorderSide(color: Colors.deepPurple, width: 2),
                  ),
                  contentPadding: const EdgeInsets.all(16),
                ),
              ),
              const SizedBox(height: 24),

              // Submit button
              ElevatedButton(
                onPressed: () {
                  String alasan = _alasanController.text;
                  String cocok = _cocokController.text;

                  if (alasan.isNotEmpty && cocok.isNotEmpty) {
                    // Show dialog with input data
                    showDialog(
                      context: context,
                      builder: (context) => AlertDialog(
                        title: const Text("Data Pendaftaran"),
                        content: Text(
                          "Alasan Anda memilih pekerjaan:\n$alasan\n\nAlasan Anda cocok:\n$cocok",
                          style: const TextStyle(fontSize: 16),
                        ),
                        actions: [
                          TextButton(
                            onPressed: () => Navigator.pop(context),
                            child: const Text("Tutup"),
                          ),
                          ElevatedButton(
                            onPressed: () {
                              // Simulate successful submission
                              Navigator.pop(context);
                              ScaffoldMessenger.of(context).showSnackBar(
                                const SnackBar(content: Text("Pendaftaran berhasil!")),
                              );
                            },
                            style: ElevatedButton.styleFrom(
                              backgroundColor: Colors.deepPurple,
                            ),
                            child: const Text("Kirim"),
                          ),
                        ],
                      ),
                    );
                  } else {
                    ScaffoldMessenger.of(context).showSnackBar(
                      const SnackBar(content: Text('Harap lengkapi semua kolom')),
                    );
                  }
                },
                style: ElevatedButton.styleFrom(
                  padding: const EdgeInsets.symmetric(horizontal: 30, vertical: 15),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(8),
                  ),
                ),
                child: const Text(
                  "Kirim Pendaftaran",
                  style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
