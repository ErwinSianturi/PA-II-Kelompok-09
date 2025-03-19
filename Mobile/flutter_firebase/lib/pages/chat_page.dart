import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:flutter/material.dart';
import 'package:flutter_firebase/Services/auth/auth_service.dart';
import 'package:flutter_firebase/Services/chat/chat_services.dart';
import 'package:flutter_firebase/components/chat_bubble.dart';
import 'package:flutter_firebase/components/my_textfld.dart';

class ChatPage extends StatefulWidget {
  final String receiverEmail;
  final String receiverID; 

  ChatPage({
    super.key,
    required this.receiverEmail,
    required this.receiverID,
  });

  @override
  State<ChatPage> createState() => _ChatPageState();
}

class _ChatPageState extends State<ChatPage> {
  final TextEditingController _messageController = TextEditingController();

  //Chat auth serice
  final ChatServices _chatServices = ChatServices();

  final AuthService _authService = AuthService();

  // field focus
  FocusNode myFocusNode = FocusNode();

  @override
  void initState(){
    super.initState();

    myFocusNode.addListener((){
      if (myFocusNode.hasFocus){
        // cause delau so keyboard habe delay


        Future.delayed(const Duration(milliseconds: 300),
        () => scrollDown(),

        );
      }
    });
  Future.delayed(
    const Duration(milliseconds: 300),
    () => scrollDown(),
  );
     
  }

  @override
  void dispose(){
    myFocusNode.dispose();
    _messageController.dispose();
    super.dispose();
  }

  final ScrollController _scrollController = ScrollController();
  void scrollDown(){
    _scrollController.animateTo(
      _scrollController.position.maxScrollExtent, 
      duration: const Duration(milliseconds: 300), 
      curve: Curves.fastOutSlowIn,
      );
  }


  void sendMessage() async {
    if (_messageController.text.isNotEmpty){
      //send 
      await _chatServices.sendMessage(widget.receiverID, _messageController.text);

      _messageController.clear();
      scrollDown();
    
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar:  AppBar(title: Text(widget.receiverEmail)),
      body: Column(
        children: [
          Expanded(
            child: _buildMessageList(), 
            
          ),

          _buildUserInput(),
        ],
      ),
    );
    
  }

  Widget _buildMessageList(){
    String senderID = _authService.getCurrentUser()!.uid;
    return StreamBuilder(
      stream: _chatServices.getMessages(widget.receiverID, senderID), 
      builder: (context, snapshot){
        if (snapshot.hasError){
          return const Text("Error");
        }

        if(snapshot.connectionState == ConnectionState.waiting ){
          return const Text("Loading...");
        }

        return ListView(
          controller: _scrollController,
          children: snapshot.data!.docs.map((doc) => _buildMessageItem(doc)).toList()
        );
      })
      
      
      ;
  }

  Widget _buildMessageItem(DocumentSnapshot doc)  {
    Map<String, dynamic> data = doc.data() as Map<String, dynamic>;

    // is current user
    bool isCurrentUser = data['senderID'] == _authService.getCurrentUser()!.uid;

    var aligment = 
    isCurrentUser ? Alignment.centerRight : Alignment.centerLeft;

    // align message to right sender curr user, other left

    return Container(
      alignment: aligment,
      child: Column(
        crossAxisAlignment: isCurrentUser ? CrossAxisAlignment.end : CrossAxisAlignment.start ,
        children: [
          ChatBubble(
            message: data["message"], 
            isCurrentUser: isCurrentUser
          ),
        ],
      ),);
  } 

  // inpit
  Widget _buildUserInput(){
    return Row(
      children: [
        // textfield should 

        Expanded(child: MyTextfld(
          controller: _messageController,
          hintText: "Type a message",
          obscureText: false,
          focusNode: myFocusNode,
        ),
        ),

        IconButton(
        onPressed: sendMessage, 
        icon: const Icon(Icons.arrow_upward),
        ),


      ],
    );
  }
}