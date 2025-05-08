import 'dart:convert';
import 'package:flutter_application/pages/models/user_profile.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class ProfileService {
  // Base URL API
  final String baseUrl = 'http://10.0.2.2:8080'; // Ganti dengan URL API Anda

  // Mendapatkan profil pengguna dari API
  Future<UserProfile> getUserProfile(int userId) async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/users/$userId'),
        headers: {'Content-Type': 'application/json'},
      );

      if (response.statusCode == 200) {
        return UserProfile.fromJson(json.decode(response.body)['data']);
      } else {
        throw Exception('Gagal memuat data profil');
      }
    } catch (e) {
      // Jika terjadi error, coba ambil dari penyimpanan lokal
      return _getProfileFromLocal();
    }
  }

  // Menyimpan profil ke penyimpanan lokal (SharedPreferences)
  Future<void> _saveProfileToLocal(UserProfile profile) async {
    try {
      final prefs = await SharedPreferences.getInstance();
      final profileJson = json.encode(profile.toJson());
      
      // Debug log
      print("Menyimpan profil ke penyimpanan lokal: $profileJson");
      
      await prefs.setString('user_profile', profileJson);
    } catch (e) {
      print("Error saat menyimpan profil ke penyimpanan lokal: $e");
    }
  }

  // Mengambil profil dari penyimpanan lokal
  Future<UserProfile> _getProfileFromLocal() async {
    final prefs = await SharedPreferences.getInstance();
    String? profileJson = prefs.getString('user_profile');
    
    if (profileJson != null) {
      return UserProfile.fromJson(json.decode(profileJson));
    } else {
      // Profil default jika tidak ada data tersimpan
      return UserProfile(
        id: 1,
        name: 'Yenny Angelita Gurning',
        email: 'yennyangelita@gmail.com',
        address: 'Jakarta',
        occupation: 'Mahasiswa',
        birthDate: DateTime.now(),
        photoUrl: null,
        lastUpdate: DateTime.now().toString(),
      );
    }
  }

  // Menyimpan profil pengguna ke API
  Future<UserProfile> updateUserProfile(UserProfile profile) async {
    try {
      // Coba update ke API
      final response = await http.put(
        Uri.parse('$baseUrl/users/${profile.id}'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode(profile.toJson()),
      );

      if (response.statusCode == 200) {
        UserProfile updatedProfile = UserProfile.fromJson(json.decode(response.body)['data']);
        // Simpan juga ke penyimpanan lokal
        await _saveProfileToLocal(updatedProfile);
        return updatedProfile;
      } else {
        // Jika API gagal, simpan ke lokal saja
        profile.lastUpdate = DateTime.now().toString();
        await _saveProfileToLocal(profile);
        return profile;
      }
    } catch (e) {
      // Jika terjadi error, simpan ke penyimpanan lokal saja
      profile.lastUpdate = DateTime.now().toString();
      await _saveProfileToLocal(profile);
      return profile;
    }
  }
}
