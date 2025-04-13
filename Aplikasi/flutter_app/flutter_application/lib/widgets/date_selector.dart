import 'package:flutter/material.dart';
import 'package:intl/intl.dart';

class HomeWithDateSelector extends StatefulWidget {
  const HomeWithDateSelector({super.key});

  @override
  State<HomeWithDateSelector> createState() => _HomeWithDateSelectorState();
}

class _HomeWithDateSelectorState extends State<HomeWithDateSelector> {
  late List<Map<String, String>> dates;
  late String selectedDate;

  @override
  void initState() {
    super.initState();
    final now = DateTime.now();
    selectedDate = DateFormat('yyyy-MM-dd').format(now);

    dates = List.generate(14, (index) {
      final date = now.add(Duration(days: index));
      return {
        'day': DateFormat('d').format(date),
        'label': DateFormat.EEEE('id_ID').format(date),
        'dateKey': DateFormat('yyyy-MM-dd').format(date),
      };
    });
  }

  void onDateSelected(String dateKey) {
    setState(() {
      selectedDate = dateKey;
    });

    // Tambahkan logika untuk filter pekerjaan berdasarkan tanggal di sini
    debugPrint('Tanggal dipilih: $selectedDate');
  }

  @override
  Widget build(BuildContext context) {
    return SizedBox(
      height: 90,
      child: SingleChildScrollView(
        scrollDirection: Axis.horizontal,
        child: Row(
          children: dates.map((date) {
            final bool isSelected = date['dateKey'] == selectedDate;
            return Padding(
              padding: const EdgeInsets.only(right: 12.0),
              child: GestureDetector(
                onTap: () => onDateSelected(date['dateKey']!),
                child: Column(
                  children: [
                    Text(
                      DateFormat.MMMM('id_ID').format(
                        DateTime.parse(date['dateKey']!),
                      ),
                    ),
                    const SizedBox(height: 4),
                    Container(
                      decoration: BoxDecoration(
                        color: isSelected ? Colors.purple : Colors.transparent,
                        borderRadius: BorderRadius.circular(12),
                        border: Border.all(
                          color: isSelected ? Colors.purple : Colors.grey.shade300,
                        ),
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
              ),
            );
          }).toList(),
        ),
      ),
    );
  }
}
