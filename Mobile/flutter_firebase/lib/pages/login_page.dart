import 'package:flutter/material.dart';
import 'package:flutter_firebase/Services/auth/auth_service.dart';
import 'package:flutter_firebase/components/my_button.dart';
import 'package:flutter_firebase/components/my_textfld.dart';

class LoginPage extends StatelessWidget {
  // Email and password controllers
  final TextEditingController _pwController = TextEditingController();
  final TextEditingController _emlController = TextEditingController();

  LoginPage({super.key, required this.onTap});

  //tap to register
  final void Function()? onTap;

  void login(BuildContext context) async {
    //auth
    final authService = AuthService();
    //try
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
      backgroundColor: Colors.grey,
      body: Center(
        // Removed const here
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Icon(
              Icons.message,
              size: 60,
            ),
            const SizedBox(
              height: 50,
            ),
            Text(
              "Welcome Back! We Missed you",
              style: TextStyle(
                color: Colors.blue,
                fontSize: 16,
              ),
            ),
            const SizedBox(
              height: 50,
            ),
            MyTextfld(
              hintText: "Email",
              obscureText: false,
              controller: _emlController,
            ),
            const SizedBox(
              height: 20,
            ),
            MyTextfld(
              hintText: "Password",
              obscureText: true,
              controller: _pwController,
            ),
            const SizedBox(
              height: 20,
            ),
            MyButton(button: "Login", onTap: () => login(context)),
            const SizedBox(
              height: 20,
            ),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Text("Don't have an account? Sign up now"),
                GestureDetector(
                  onTap: onTap,
                  child: Text("Register"),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }
}
