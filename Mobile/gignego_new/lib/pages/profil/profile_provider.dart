import 'package:flutter/material.dart';
import 'package:flutter_application/pages/models/user_profile.dart';
import 'package:flutter_application/pages/profil/profile_service.dart';

class ProfileProvider extends ChangeNotifier {
  final ProfileService _profileService = ProfileService();
  UserProfile? _userProfile;
  bool _isLoading = false;
  String? _error;

  // Getter
  UserProfile? get userProfile => _userProfile;
  bool get isLoading => _isLoading;
  String? get error => _error;

  // Konstruktor dengan inisialisasi opsional
  ProfileProvider({int? userId}) {
    if (userId != null) {
      fetchUserProfile(userId);
    }
  }

  // Mengambil data profil pengguna
  Future<void> fetchUserProfile(int userId) async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      _userProfile = await _profileService.getUserProfile(userId);
      _isLoading = false;
      notifyListeners();
    } catch (e) {
      _isLoading = false;
      _error = e.toString();
      notifyListeners();
    }
  }

  // Memperbarui data profil pengguna
  Future<bool> updateUserProfile(UserProfile updatedProfile) async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      // Simpan ke API
      final result = await _profileService.updateUserProfile(updatedProfile);
      
      // Update state lokal
      _userProfile = result;
      
      _isLoading = false;
      notifyListeners();
      
      // Debug log
      print("Profil berhasil diperbarui: ${_userProfile?.name}, ${_userProfile?.email}, ${_userProfile?.address}");
      
      return true;
    } catch (e) {
      _isLoading = false;
      _error = e.toString();
      notifyListeners();
      
      // Debug log
      print("Error saat memperbarui profil: $e");
      
      return false;
    }
  }

  Future<bool> updateProfilePhoto(String photoUrl) async {
    if (_userProfile == null) return false;

    try {
      UserProfile updatedProfile = UserProfile(
        id: _userProfile!.id,
        name: _userProfile!.name,
        email: _userProfile!.email,
        address: _userProfile!.address,
        occupation: _userProfile!.occupation,
        birthDate: _userProfile!.birthDate,
        photoUrl: photoUrl,
        lastUpdate: DateTime.now().toString(),
      );
      return await updateUserProfile(updatedProfile);
    } catch (e) {
      _error = e.toString();
      notifyListeners();
      return false;
    }
  }
}
