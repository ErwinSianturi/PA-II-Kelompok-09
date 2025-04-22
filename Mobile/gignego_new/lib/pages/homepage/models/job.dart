class Job {
  final String judul;
  final String deskripsi;
  final String lokasi;
  final String waktu;
  final String tanggal;
  final String harga;
  final String masaIklan;
  final String kategori;
  final String gambar;
  late final String status;


  Job({
    required this.judul,
    required this.deskripsi,
    required this.lokasi,
    required this.waktu,
    required this.tanggal,
    required this.harga,
    required this.masaIklan,
    required this.kategori,
    required this.gambar,
    required this.status,
  });

  Map<String, dynamic> toMap() {
    return {
      'judul': judul,
      'deskripsi': deskripsi,
      'lokasi': lokasi,
      'waktu': waktu,
      'tanggal': tanggal,
      'harga': harga,
      'masaIklan': masaIklan,
      'kategori': kategori,
      'gambar': gambar,
      'status': status,
    };
  }

  factory Job.fromMap(Map<String, dynamic> map) {
    return Job(
      judul: map['judul'] ?? '',
      deskripsi: map['deskripsi'] ?? '',
      lokasi: map['lokasi'] ?? '',
      waktu: map['waktu'] ?? '',
      tanggal: map['tanggal'] ?? '',
      harga: map['harga'] ?? '',
      masaIklan: map['masaIklan'] ?? '',
      kategori: map['kategori'] ?? '',
      gambar: map['gambar'] ?? '',
      status: map['status'] ?? 'Tersedia',
    );
  }

  Job copyWith({
    String? judul,
    String? deskripsi,
    String? lokasi,
    String? waktu,
    String? tanggal,
    String? harga,
    String? masaIklan,
    String? kategori,
    String? gambar,
    String? status,
  }) {
    return Job(
      judul: judul ?? this.judul,
      deskripsi: deskripsi ?? this.deskripsi,
      lokasi: lokasi ?? this.lokasi,
      waktu: waktu ?? this.waktu,
      tanggal: tanggal ?? this.tanggal,
      harga: harga ?? this.harga,
      masaIklan: masaIklan ?? this.masaIklan,
      kategori: kategori ?? this.kategori,
      gambar: gambar ?? this.gambar,
      status: status ?? this.status,
    );
  }

  @override
  String toString() {
    return 'Job(judul: $judul, deskripsi: $deskripsi, lokasi: $lokasi, waktu: $waktu, tanggal: $tanggal, harga: $harga, masaIklan: $masaIklan, kategori: $kategori, gambar: $gambar, status: $status)';
  }
}
