import 'dart:io';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:intl/intl.dart';
import 'package:provider/provider.dart';
import 'package:flutter_application/pages/models/user_profile.dart';
import 'package:flutter_application/pages/profil/profile_provider.dart';

class EditProfilPage extends StatefulWidget {
  const EditProfilPage({Key? key}) : super(key: key);

  @override
  _EditProfilPageState createState() => _EditProfilPageState();
}

class _EditProfilPageState extends State<EditProfilPage> {
  final TextEditingController _nameController = TextEditingController();
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _addressController = TextEditingController();
  String _selectedOccupation = 'Mahasiswa';
  DateTime _selectedDate = DateTime.now();
  File? _imageFile;
  bool _isLoading = false;

  final List<String> _occupationOptions = [
    'Mahasiswa',
    'Karyawan',
    'Wiraswasta',
    'Freelancer',
    'Lainnya'
  ];

  @override
  void initState() {
    super.initState();
    // Data akan diisi di didChangeDependencies
  }

  @override
  void didChangeDependencies() {
    super.didChangeDependencies();
    _loadUserProfile();
  }

  // Memuat data profil pengguna
  void _loadUserProfile() {
    try {
      final profileProvider = Provider.of<ProfileProvider>(context, listen: false);
      final userProfile = profileProvider.userProfile;

      if (userProfile != null) {
        setState(() {
          _nameController.text = userProfile.name;
          _emailController.text = userProfile.email;
          _addressController.text = userProfile.address;
          _selectedOccupation = userProfile.occupation;
          _selectedDate = userProfile.birthDate;
        });
      }
    } catch (e) {
      print("Error saat memuat profil: $e");
    }
  }

  // Memilih gambar dari galeri
  Future<void> _pickImage() async {
    final ImagePicker picker = ImagePicker();
    final XFile? pickedFile = await picker.pickImage(source: ImageSource.gallery);

    if (pickedFile != null) {
      setState(() {
        _imageFile = File(pickedFile.path);
      });
    }
  }

  // Memilih tanggal lahir
  Future<void> _selectDate(BuildContext context) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: _selectedDate,
      firstDate: DateTime(1900),
      lastDate: DateTime.now(),
    );

    if (picked != null && picked != _selectedDate) {
      setState(() {
        _selectedDate = picked;
      });
    }
  }

  // Validasi form
  bool _validateForm() {
    if (_nameController.text.isEmpty) {
      _showErrorSnackBar('Nama tidak boleh kosong');
      return false;
    }
    if (_emailController.text.isEmpty) {
      _showErrorSnackBar('Email tidak boleh kosong');
      return false;
    }
    if (_addressController.text.isEmpty) {
      _showErrorSnackBar('Alamat tidak boleh kosong');
      return false;
    }
    return true;
  }

  void _showErrorSnackBar(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text(message)),
    );
  }

  // Menyimpan perubahan profil
  Future<void> _saveProfile() async {
    if (!_validateForm()) return;

    setState(() {
      _isLoading = true;
    });

    try {
      final profileProvider = Provider.of<ProfileProvider>(context, listen: false);
      final currentProfile = profileProvider.userProfile;

      if (currentProfile != null) {
        // Update profil dengan data baru
        UserProfile updatedProfile = UserProfile(
          id: currentProfile.id,
          name: _nameController.text,
          email: _emailController.text,
          address: _addressController.text,
          occupation: _selectedOccupation,
          birthDate: _selectedDate,
          photoUrl: currentProfile.photoUrl, // Akan diperbarui jika ada foto baru
          lastUpdate: DateTime.now().toString(),
        );

        // Jika ada gambar baru, upload gambar
        if (_imageFile != null) {
          // Dalam implementasi nyata, Anda perlu mengupload gambar ke server
          // dan mendapatkan URL gambar yang disimpan
          String mockPhotoUrl =
              "https://example.com/photos/profile_${DateTime.now().millisecondsSinceEpoch}.jpg";
          
          updatedProfile = UserProfile(
            id: updatedProfile.id,
            name: updatedProfile.name,
            email: updatedProfile.email,
            address: updatedProfile.address,
            occupation: updatedProfile.occupation,
            birthDate: updatedProfile.birthDate,
            photoUrl: mockPhotoUrl, // URL foto baru
            lastUpdate: updatedProfile.lastUpdate,
          );
        }

        // Simpan perubahan
        final success = await profileProvider.updateUserProfile(updatedProfile);

        if (success) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(content: Text('Profil berhasil diperbarui')),
          );
          
          // Refresh data di provider
          await profileProvider.fetchUserProfile(updatedProfile.id ?? 18);
          
          // Kembali ke halaman profil
          Navigator.pop(context, true); // Mengirim hasil true untuk trigger refresh
        } else {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(content: Text('Gagal memperbarui profil')),
          );
        }
      }
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Terjadi kesalahan: $e')),
      );
    } finally {
      setState(() {
        _isLoading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Edit Profil'),
        centerTitle: true,
        backgroundColor: Colors.white,
        foregroundColor: Colors.black,
        elevation: 0,
        leading: TextButton(
          onPressed: () => Navigator.pop(context),
          child: Text('Batal', style: TextStyle(color: Colors.black)),
        ),
        leadingWidth: 80,
        actions: [
          Center(
            child: Padding(
              padding: const EdgeInsets.only(right: 16.0),
              child: Text(
                'GIGNEGO',
                style: TextStyle(
                  color: Color(0xFF9E61EB),
                  fontWeight: FontWeight.bold,
                ),
              ),
            ),
          ),
        ],
      ),
      body: Consumer<ProfileProvider>(
        builder: (context, profileProvider, child) {
          final userProfile = profileProvider.userProfile;
          
          if (userProfile == null) {
            return Center(child: CircularProgressIndicator());
          }
          
          return SingleChildScrollView(
            padding: EdgeInsets.all(16.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // Foto profil
                Center(
                  child: Stack(
                    children: [
                      CircleAvatar(
                        radius: 50,
                        backgroundColor: Colors.grey[300],
                        backgroundImage: _imageFile != null
                            ? FileImage(_imageFile!)
                            : (userProfile.photoUrl != null
                                ? NetworkImage(userProfile.photoUrl!)
                                    as ImageProvider
                                : AssetImage("assets/profile.jpg")
                                    as ImageProvider),
                      ),
                      Positioned(
                        bottom: 0,
                        right: 0,
                        child: GestureDetector(
                          onTap: _pickImage,
                          child: CircleAvatar(
                            radius: 18,
                            backgroundColor: Color(0xFF9E61EB),
                            child: Icon(Icons.edit, color: Colors.white),
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
                SizedBox(height: 24),
                
                // Nama
                Text('Nama', style: TextStyle(color: Colors.grey)),
                TextField(
                  controller: _nameController,
                  decoration: InputDecoration(
                    hintText: 'Masukkan nama lengkap',
                    border: UnderlineInputBorder(),
                  ),
                ),
                SizedBox(height: 16),
                
                // Email
                Text('Email', style: TextStyle(color: Colors.grey)),
                TextField(
                  controller: _emailController,
                  decoration: InputDecoration(
                    hintText: 'Masukkan email',
                    border: UnderlineInputBorder(),
                  ),
                  keyboardType: TextInputType.emailAddress,
                ),
                SizedBox(height: 16),
                
                // Alamat
                Text('Alamat', style: TextStyle(color: Colors.grey)),
                TextField(
                  controller: _addressController,
                  decoration: InputDecoration(
                    hintText: 'Masukkan alamat',
                    border: UnderlineInputBorder(),
                  ),
                ),
                SizedBox(height: 16),
                
                // Pekerjaan
                Text('Pekerjaan', style: TextStyle(color: Colors.grey)),
                DropdownButtonFormField<String>(
                  value: _selectedOccupation,
                  decoration: InputDecoration(
                    border: UnderlineInputBorder(),
                  ),
                  items: _occupationOptions.map((String value) {
                    return DropdownMenuItem<String>(
                      value: value,
                      child: Text(value),
                    );
                  }).toList(),
                  onChanged: (newValue) {
                    setState(() {
                      _selectedOccupation = newValue!;
                    });
                  },
                ),
                SizedBox(height: 16),
                
                // Tanggal Lahir
                Text('Tanggal Lahir', style: TextStyle(color: Colors.grey)),
                InkWell(
                  onTap: () => _selectDate(context),
                  child: InputDecorator(
                    decoration: InputDecoration(
                      border: UnderlineInputBorder(),
                      suffixIcon: Icon(Icons.calendar_today),
                    ),
                    child: Text(
                      DateFormat('yyyy-MM-dd').format(_selectedDate),
                    ),
                  ),
                ),
                SizedBox(height: 32),
                
                // Tombol Simpan
                SizedBox(
                  width: double.infinity,
                  height: 50,
                  child: ElevatedButton(
                    onPressed: _isLoading ? null : _saveProfile,
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Color(0xFF9E61EB),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(8),
                      ),
                    ),
                    child: _isLoading
                        ? CircularProgressIndicator(color: Colors.white)
                        : Text('Simpan', style: TextStyle(fontSize: 16)),
                  ),
                ),
              ],
            ),
          );
        },
      ),
    );
  }

  @override
  void dispose() {
    _nameController.dispose();
    _emailController.dispose();
    _addressController.dispose();
    super.dispose();
  }
}
