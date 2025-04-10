import 'package:flutter/material.dart';
import '../pages/available_jobs_page.dart';
import '../pages/process_jobs_page.dart';
import '../pages/all_jobs_page.dart';
import '../pages/job_list_page.dart'; 

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

    // Navigasi ke halaman sesuai status
    switch (status) {
      case "Semua":
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => const JobListPage()),
        );
        break;
      case "Tersedia":
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => const AvailableJobsPage()),
        );
        break;
      case "Dalam Proses":
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => const ProcessJobsPage()),
        );
        break;
      case "Selesai":
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => const AllJobsPage()),
        );
        break;
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
        ],
      ),
    );
  }
}
