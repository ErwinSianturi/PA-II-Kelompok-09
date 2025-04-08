import 'package:flutter/material.dart';
import '../pages/available_jobs_page.dart';
import '../pages/process_jobs_page.dart';
import '../pages/all_jobs_page.dart';

class TabFilter extends StatefulWidget {
  const TabFilter({super.key});

  @override
  State<TabFilter> createState() => _TabFilterState();
}

class _TabFilterState extends State<TabFilter> {
  String selectedStatus = "Semua";

  void _onChipTap(String status) {
    setState(() {
      selectedStatus = status;
    });

    if (status == "Tersedia") {
      Navigator.push(
        context,
        MaterialPageRoute(builder: (context) => const AvailableJobsPage()),
      );
    } else if (status == "Dalam Proses") {
      Navigator.push(
        context,
        MaterialPageRoute(builder: (context) => const ProcessJobsPage()),
      );
    } else if (status == "Selesai") {
      Navigator.push(
      context,
      MaterialPageRoute(builder: (context) => const AllJobsPage()),
      );
    }
    
  }

  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      scrollDirection: Axis.horizontal,
      padding: const EdgeInsets.symmetric(horizontal: 8.0),
      child: Row(
        children: [
          FilterChip(
            label: const Text("Semua"),
            selected: selectedStatus == "Semua",
            onSelected: (_) => _onChipTap("Semua"),
          ),
          const SizedBox(width: 8),
          FilterChip(
            label: const Text("Tersedia"),
            selected: selectedStatus == "Tersedia",
            onSelected: (_) => _onChipTap("Tersedia"),
          ),
          const SizedBox(width: 8),
          FilterChip(
            label: const Text("Dalam Proses"),
            selected: selectedStatus == "Dalam Proses",
            onSelected: (_) => _onChipTap("Dalam Proses"),
          ),
          const SizedBox(width: 8),
          FilterChip(
            label: const Text("Selesai"),
            selected: selectedStatus == "Selesai",
            onSelected: (_) => _onChipTap("Selesai"),
          ),
          const SizedBox(width: 16),
          ElevatedButton(
            style: ElevatedButton.styleFrom(
              shape: const CircleBorder(),
              padding: const EdgeInsets.all(12),
              backgroundColor: Theme.of(context).primaryColor,
            ),
            onPressed: () {
              ScaffoldMessenger.of(context).showSnackBar(
                SnackBar(content: Text('Filter "$selectedStatus" dipilih')),
              );
            },
            child: const Icon(Icons.check, color: Colors.white),
          ),
        ],
      ),
    );
  }
}
