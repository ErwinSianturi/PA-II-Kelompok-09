import 'package:flutter/material.dart';
import 'package:flutter_firebase/Services/auth/auth_service.dart';
import 'package:flutter_firebase/components/my_button.dart';
import 'package:flutter_firebase/components/my_textfld.dart';

class RegisterPage extends StatelessWidget {
  final TextEditingController _pwController = TextEditingController();
  final TextEditingController _emlController = TextEditingController();
  final TextEditingController _confController = TextEditingController();
  RegisterPage({super.key, required this.onTap});

  //tap to register
  final void Function()? onTap;

  void register(BuildContext context){
    final _auth = AuthService();
    if(_pwController.text == _confController.text){
      try{
        _auth.signUpWithEmailPassword(
          _emlController.text,
          _pwController.text
        );
      } catch (e){
        showDialog(
          context: context,
          builder: (context) => AlertDialog(
                title: Text(e.toString()),
              ));
      }
    } else {
    
        showDialog(
          context: context,
          builder: (context) => AlertDialog(
                title: Text("Pass dont match"),
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
              "Lets Create ACCOUNT FOT THOU",
              style: TextStyle(
                color: Colors.blue,
                fontSize: 16,
              ),
            ),
            const SizedBox(
              height: 50,
            ),

            //email
            MyTextfld(
              hintText: "Email",
              obscureText: false,
              controller: _emlController,
            ),
            
            const SizedBox(
              height: 20,
            ),
            // pass
            MyTextfld(
              hintText: "Password",
              obscureText: true,
              controller: _pwController,
            ),
            const SizedBox(
              height: 20,
            ),
            MyTextfld(
              hintText: "Confirm Password",
              obscureText: true,
              controller: _confController,
            ),
            const SizedBox(
              height: 20,
            ),

            MyButton(
              button: "Register",
              onTap: () => register(context),
            ),
            const SizedBox(
              height: 20,
            ),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Text("Already have?"),
                Text("LOGIN"),
              ],
            ),
          ],
        ),
      ),
    );
  }
}
