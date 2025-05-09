import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:google_sign_in/google_sign_in.dart';
import 'package:flutter_facebook_auth/flutter_facebook_auth.dart';
import 'package:flutter_firebase/Services/auth/auth_service.dart';
import 'package:flutter_firebase/components/my_button.dart';
import 'package:flutter_firebase/components/my_textfld.dart';
import 'package:flutter_firebase/pages/chat/home_page.dart';


class RegisterPage extends StatefulWidget {
  final void Function()? onTap;
  const RegisterPage({super.key, required this.onTap});

  @override
  _RegisterPageState createState() => _RegisterPageState();
}

class _RegisterPageState extends State<RegisterPage> {
  final _formKey = GlobalKey<FormState>();
  final _pwController = TextEditingController();
  final _emlController = TextEditingController();
  final _confController = TextEditingController();
  final _namaController = TextEditingController();
  final _nomorController = TextEditingController();
  bool _isFormValid = false;

  void _checkFormValidity() {
    final isValid = _formKey.currentState?.validate() ?? false;
    setState(() => _isFormValid = isValid);
  }

  void _showMessage(String msg) {
    ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text(msg)));
  }

  void _submitForm() {
    if (_isFormValid) {
      // Implement registration logic
      Navigator.pushReplacement(context, MaterialPageRoute(builder: (_) => HomePage()));
    }
  }

  Future<void> _signInWithGoogle() async {
    try {
      final googleUser = await GoogleSignIn().signIn();
      if (googleUser != null) {
        _showMessage("Google Login Berhasil: ${googleUser.displayName} (${googleUser.email})");
        Navigator.pushReplacement(context, MaterialPageRoute(builder: (_) => HomePage()));
      }
    } catch (e) {
      _showMessage("Google Login Gagal: $e");
    }
  }

  Future<void> _signInWithFacebook() async {
    try {
      final result = await FacebookAuth.instance.login();
      if (result.status == LoginStatus.success) {
        final data = await FacebookAuth.instance.getUserData();
        _showMessage("Facebook Login Berhasil: ${data['name']} (${data['email'] ?? 'Email tidak tersedia'})");
        Navigator.pushReplacement(context, MaterialPageRoute(builder: (_) => HomePage()));
      } else {
        _showMessage("Facebook Login Gagal: ${result.message}");
      }
    } catch (e) {
      _showMessage("Facebook Error: $e");
    }
  }

  void register(BuildContext context) {
    final _auth = AuthService();
    if (_pwController.text == _confController.text) {
      try {
        _auth.signUpWithEmailPassword(
          _emlController.text,
          _pwController.text,
        );
      } catch (e) {
        showDialog(
          context: context,
          builder: (context) => AlertDialog(
            title: Text(e.toString()),
          ),
        );
      }
    } else {
      showDialog(
        context: context,
        builder: (context) => AlertDialog(
          title: Text("Passwords do not match"),
        ),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: BoxDecoration(
          gradient: LinearGradient(
            colors: [Colors.blue, Colors.lightBlueAccent],
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
          ),
        ),
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(20),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Icon(
                Icons.message,
                size: 60,
                color: Colors.white,
              ),
              const SizedBox(height: 30),
              const Text(
                "Let's Create Your Account",
                style: TextStyle(
                  color: Colors.white,
                  fontSize: 24,
                  fontWeight: FontWeight.bold,
                ),
              ),
              const SizedBox(height: 30),
              Form(
                key: _formKey,
                onChanged: _checkFormValidity,
                child: Column(
                  children: [
                    MyTextfld(
                      hintText: "Email",
                      obscureText: false,
                      controller: _emlController,
                    ),
                    const SizedBox(height: 20),
                    MyTextfld(
                      hintText: "Password",
                      obscureText: true,
                      controller: _pwController,
                    ),
                    const SizedBox(height: 20),
                    MyTextfld(
                      hintText: "Confirm Password",
                      obscureText: true,
                      controller: _confController,
                    ),
                    const SizedBox(height: 20),
                    MyTextfld(
                      hintText: "Full Name",
                      obscureText: false,
                      controller: _namaController,
                    ),
                    const SizedBox(height: 20),
                    MyTextfld(
                      hintText: "Phone Number",
                      obscureText: false,
                      controller: _nomorController,
                    ),
                    const SizedBox(height: 20),
                    MyButton(
                      button: "Register",
                      onTap: () => register(context),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 20),
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  const Text(
                    "Already have an account? ",
                    style: TextStyle(color: Colors.white),
                  ),
                  GestureDetector(
                    onTap: widget.onTap,
                    child: const Text(
                      "LOGIN",
                      style: TextStyle(
                        color: Colors.orangeAccent,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 20),
              _buildSocialButton(
                icon: 'assets/Gogle.png',
                text: "Daftar dengan Google",
                onPressed: _signInWithGoogle,
              ),
              const SizedBox(height: 12),
              _buildSocialButton(
                icon: 'assets/Fb.png',
                text: "Daftar dengan Facebook",
                onPressed: _signInWithFacebook,
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildSocialButton({
    required String icon,
    required String text,
    required VoidCallback onPressed,
  }) {
    return SizedBox(
      width: double.infinity,
      child: OutlinedButton(
        onPressed: onPressed,
        style: OutlinedButton.styleFrom(
          padding: const EdgeInsets.symmetric(vertical: 14),
          side: const BorderSide(color: Colors.purple),
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
        ),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Image.asset(icon, height: 24),
            const SizedBox(width: 10),
            Text(text, style: const TextStyle(color: Colors.purple, fontWeight: FontWeight.bold)),
          ],
        ),
      ),
    );
  }
}
