import 'package:cloud_firestore/cloud_firestore.dart';

class FirebaseService {
  final _db = FirebaseFirestore.instance;

  Future<List<Map<String, dynamic>>> getJobList() async {
    final snapshot = await _db.collection('jobs').get();
    return snapshot.docs.map((doc) => doc.data()).toList();
  }

  // Bisa tambahkan fungsi lain kayak addJob(), updateJob(), deleteJob() di sini
}
