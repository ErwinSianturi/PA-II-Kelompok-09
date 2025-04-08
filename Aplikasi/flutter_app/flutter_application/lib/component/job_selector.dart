import 'package:flutter/material.dart';

class DateSelector extends StatelessWidget {
  const DateSelector({super.key});

  @override
  Widget build(BuildContext context) {
    final List<Map<String, String>> dates = [
      {'day': '1', 'label': 'Senin'},
      {'day': '2', 'label': 'Selasa'},
      {'day': '3', 'label': 'Rabu'},
      {'day': '4', 'label': 'Kamis'},
      {'day': '5', 'label': 'Jumat'},
      {'day': '6', 'label': 'Sabtu'},
      {'day': '7', 'label': 'Minggu'},
      {'day': '8', 'label': 'Senin'},
      {'day': '9', 'label': 'Selasa'},
      {'day': '10', 'label': 'Rabu'},
      {'day': '11', 'label': 'Kamis'},
      {'day': '12', 'label': 'Jumat'},
      {'day': '13', 'label': 'Sabtu'},
      {'day': '14', 'label': 'Minggu'},
    ];

    return SizedBox(
      height: 80,
      child: SingleChildScrollView(
        scrollDirection: Axis.horizontal,
        child: Row(
          children: dates.map((date) {
            final bool isSelected = date['day'] == '8';
            return Padding(
              padding: const EdgeInsets.only(right: 12.0),
              child: Column(
                children: [
                  const Text('Maret'),
                  const SizedBox(height: 4),
                  Container(
                    decoration: BoxDecoration(
                      color: isSelected ? Colors.purple : Colors.transparent,
                      borderRadius: BorderRadius.circular(12),
                    ),
                    padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
                    child: Column(
                      children: [
                        Text(
                          date['day']!,
                          style: TextStyle(
                            color: isSelected ? Colors.white : Colors.black,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        Text(
                          date['label']!,
                          style: TextStyle(
                            color: isSelected ? Colors.white : Colors.black,
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            );
          }).toList(),
        ),
      ),
    );
  }
}
