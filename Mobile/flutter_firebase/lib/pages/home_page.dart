import 'package:firebase_auth/firebase_auth.dart';
import 'package:flutter/material.dart';
import 'package:flutter_firebase/Services/auth/auth_service.dart';
import 'package:flutter_firebase/Services/chat/chat_services.dart';
import 'package:flutter_firebase/components/user_tile.dart';
import 'package:flutter_firebase/pages/chat_page.dart';


class HomePage extends StatelessWidget {
  HomePage({super.key});

  // auth chat
  final ChatServices _chatServices = ChatServices();
  final AuthService _authService = AuthService();



  void logout(){
    final _auth = AuthService();
    _auth.signOut();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Home Page"),
        actions: [
          IconButton(onPressed: logout, icon: Icon(Icons.logout))
        ],
      ),
      drawer: Drawer(),
      body: _buildUserList(),
    );
  }

  Widget _buildUserList(){
    return StreamBuilder(
      stream: _chatServices.getUserStream(),
      builder: (context, snapshot) {
      // error
      if(snapshot.hasError){
        return const Text("error");
      }  

      if(snapshot.connectionState == ConnectionState.waiting){
          return const Text("Loading");
      }

      return ListView(
        children: snapshot.data!
        .map<Widget>((userData) => _buildUserListItem(userData, context))
        .toList()
      );

      },
    );
  }
  Widget _buildUserListItem(Map<String, dynamic> userData, BuildContext context){
    if(userData["email"] != _authService.getCurrentUser()!.email ){
      return UserTile(
      text: userData["email"],
      onTap: (){
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => ChatPage(
              receiverEmail: userData["email"],
              receiverID: userData ["uid"],
            )
            ),
          );
      }
    );
    } else {
      return Container();
    }
  }

}