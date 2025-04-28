import 'package:flutter/material.dart';
import '../../Services/auth/auth_service.dart';
import '../chat/components/my_button.dart';
import '../chat/components/my_textfld.dart';

class LoginPage extends StatelessWidget {
  final TextEditingController _pwController = TextEditingController();
  final TextEditingController _emlController = TextEditingController();

  LoginPage({super.key, required this.onTap});

  final void Function()? onTap;

  void login(BuildContext context) async {
    final authService = AuthService();
    try {
      await authService.signInWithEmailPassword(
          _emlController.text, _pwController.text);
    } catch (e) {
      showDialog(
          context: context,
          builder: (context) => AlertDialog(
                title: Text(e.toString()),
              ));
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
        child: Center(
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
                Text(
                  "Welcome Back! We Missed You",
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 24,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 30),
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
                MyButton(
                  button: "Login",
                  onTap: () => login(context),

                ),
                const SizedBox(height: 20),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text(
                      "Don't have an account? ",
                      style: TextStyle(color: Colors.white),
                    ),
                    GestureDetector(
                      onTap: onTap,
                      child: Text(
                        "Register",
                        style: TextStyle(
                          color: Colors.orangeAccent,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
