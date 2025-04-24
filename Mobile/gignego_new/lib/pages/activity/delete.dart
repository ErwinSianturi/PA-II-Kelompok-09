import 'package:flutter/material.dart';

class DeletePekerjaanPage extends StatefulWidget {
  const DeletePekerjaanPage({super.key});

  @override
  State<DeletePekerjaanPage> createState() => _DeletePekerjaanPageState();
}

class _DeletePekerjaanPageState extends State<DeletePekerjaanPage> {
  List<String> _daftarPekerjaan = ['Kebersihan Pekarangan', 'Mencuci Kendaraan', 'Kebersihan Rumah', 'Sofa Cleaning', 'Perbaikan Rumah'];

  void _hapusPekerjaan(int index) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
        title: const Text('Konfirmasi'),
        content: const Text('Yakin ingin menghapus pekerjaan ini?'),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Batal'),
          ),
          ElevatedButton.icon(
            icon: const Icon(Icons.delete_forever),
            label: const Text('Hapus'),
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.red,
              foregroundColor: Colors.white,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(8),
              ),
            ),
            onPressed: () {
              setState(() {
                _daftarPekerjaan.removeAt(index);
              });
              Navigator.pop(context);
              ScaffoldMessenger.of(context).showSnackBar(
                const SnackBar(
                  content: Text('Pekerjaan berhasil dihapus'),
                  behavior: SnackBarBehavior.floating,
                ),
              );
            },
          ),
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF3F4F6),
      appBar: AppBar(
        title: const Text('Hapus Pekerjaan'),
        elevation: 0,
        backgroundColor: Colors.deepPurple,
        foregroundColor: Colors.white,
      ),
      body: ListView.builder(
        padding: const EdgeInsets.all(16),
        itemCount: _daftarPekerjaan.length,
        itemBuilder: (context, index) {
          final pekerjaan = _daftarPekerjaan[index];
          return Card(
            margin: const EdgeInsets.only(bottom: 12),
            elevation: 3,
            shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
            child: ListTile(
              contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
              leading: CircleAvatar(
                backgroundColor: Colors.deepPurple.shade100,
                child: const Icon(Icons.work, color: Colors.deepPurple),
              ),
              title: Text(
                pekerjaan,
                style: const TextStyle(fontWeight: FontWeight.w600),
              ),
              trailing: IconButton(
                icon: const Icon(Icons.delete_outline, color: Colors.redAccent),
                onPressed: () => _hapusPekerjaan(index),
                tooltip: 'Hapus pekerjaan',
              ),
            ),
          );
        },
      ),
    );
  }
}
