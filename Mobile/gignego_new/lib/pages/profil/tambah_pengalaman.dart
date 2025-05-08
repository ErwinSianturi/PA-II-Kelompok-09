import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class AddWorkExperiencePage extends StatefulWidget {
  final int userId; // Tambahkan parameter userId

  const AddWorkExperiencePage({
    Key? key,
    required this.userId, // Wajib menerima userId
  }) : super(key: key);

  @override
  _AddWorkExperiencePageState createState() => _AddWorkExperiencePageState();
}

class _AddWorkExperiencePageState extends State<AddWorkExperiencePage> {
  final _formKey = GlobalKey<FormState>();
  final TextEditingController _positionController = TextEditingController();
  final TextEditingController _companyController = TextEditingController();
  final TextEditingController _descriptionController = TextEditingController();
  final TextEditingController _startDateController = TextEditingController();
  final TextEditingController _endDateController = TextEditingController();

  String? _selectedCountry;
  String? _selectedCity;
  String? _selectedJobFunction;
  String? _selectedIndustry;
  String? _selectedJobLevel;
  String? _selectedJobType;
  bool _stillWorkingHere = false;

  bool isFormValid = false;
  bool _isLoading = false; // Tambahkan state loading

  List<String> countries = ['Indonesia', 'Malaysia', 'Singapura', 'Thailand'];
  List<String> cities = ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Makassar'];
  List<String> jobFunctions = [
    'IT',
    'Marketing',
    'Finance',
    'HR',
    'Operations'
  ];
  List<String> industries = [
    'Technology',
    'Healthcare',
    'Education',
    'Finance',
    'Retail'
  ];
  List<String> jobLevels = [
    'Entry Level',
    'Junior',
    'Mid-Level',
    'Senior',
    'Manager'
  ];
  List<String> jobTypes = [
    'Full-time',
    'Part-time',
    'Contract',
    'Freelance',
    'Internship'
  ];

  @override
  void dispose() {
    _positionController.dispose();
    _companyController.dispose();
    _descriptionController.dispose();
    _startDateController.dispose();
    _endDateController.dispose();
    super.dispose();
  }

  Future<void> _selectDate(
      BuildContext context, TextEditingController controller) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(1990),
      lastDate: DateTime(2101),
    );
    if (picked != null) {
      setState(() {
        controller.text = DateFormat('dd/MM/yyyy').format(picked);
        _validateForm();
      });
    }
  }

  void _validateForm() {
    setState(() {
      isFormValid = _formKey.currentState!.validate() &&
          _positionController.text.isNotEmpty &&
          _companyController.text.isNotEmpty &&
          _selectedCountry != null &&
          _selectedCity != null &&
          _selectedJobFunction != null &&
          _selectedIndustry != null &&
          _selectedJobLevel != null &&
          _selectedJobType != null &&
          _startDateController.text.isNotEmpty &&
          _descriptionController.text.isNotEmpty &&
          (_stillWorkingHere || _endDateController.text.isNotEmpty);
    });
  }

  Future<void> _saveWorkExperience() async {
    if (!_formKey.currentState!.validate() || !isFormValid) {
      return;
    }

    setState(() {
      _isLoading = true; // Aktifkan loading
    });

    try {
    final Map<String, dynamic> workExperience = {
      'position': _positionController.text,
      'company': _companyController.text,
      'country': _selectedCountry,
      'city': _selectedCity,
      'startDate': _startDateController.text,
      'endDate': _stillWorkingHere ? null : _endDateController.text,
      'currentlyWorking': _stillWorkingHere,
      'jobFunction': _selectedJobFunction,
      'industry': _selectedIndustry,
      'jobLevel': _selectedJobLevel,
      'jobType': _selectedJobType,
      'description': _descriptionController.text,
      // Tambahkan userId secara eksplisit
      'userId': widget.userId,
    };
      // Coba endpoint user work experience terlebih dahulu
      final userEndpoint = 'http://10.0.2.2:8080/user/${widget.userId}/work-experience';
      
      var response = await http.post(
        Uri.parse(userEndpoint),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode(workExperience),
      );

      // Jika gagal, coba endpoint work experiences umum
      if (response.statusCode != 201) {
        print('Endpoint user gagal, mencoba endpoint umum');
        response = await http.post(
          Uri.parse('http://10.0.2.2:8080/work-experiences'),
          headers: {'Content-Type': 'application/json'},
          body: jsonEncode(workExperience),
        );
      }

      if (response.statusCode == 201) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Pengalaman kerja berhasil disimpan'),
            backgroundColor: Colors.green,
          ),
        );
        Navigator.pop(context, true); // Kembalikan true untuk refresh halaman sebelumnya
      } else {
        print('Error response: ${response.body}');
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Error: ${response.statusCode} - ${response.body}'),
            backgroundColor: Colors.red,
          ),
        );
      }
    } catch (e) {
      print('Exception: $e');
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Error: $e'),
          backgroundColor: Colors.red,
        ),
      );
    } finally {
      setState(() {
        _isLoading = false; // Nonaktifkan loading
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Tambah Pengalaman Kerja'),
        backgroundColor: Colors.white,
        foregroundColor: Colors.black,
        elevation: 0,
      ),
      body: Stack(
        children: [
          SingleChildScrollView(
            child: Padding(
              padding: const EdgeInsets.all(16.0),
              child: Form(
                key: _formKey,
                onChanged: _validateForm,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const SizedBox(height: 16),
                    TextFormField(
                      controller: _positionController,
                      decoration: const InputDecoration(
                        labelText: 'Posisi Pekerjaan*',
                        border: OutlineInputBorder(),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Posisi pekerjaan wajib diisi';
                        }
                        return null;
                      },
                      onChanged: (value) => _validateForm(),
                    ),
                    const SizedBox(height: 16),
                    TextFormField(
                      controller: _companyController,
                      decoration: const InputDecoration(
                        labelText: 'Nama Perusahaan*',
                        border: OutlineInputBorder(),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Nama perusahaan wajib diisi';
                        }
                        return null;
                      },
                      onChanged: (value) => _validateForm(),
                    ),
                    const SizedBox(height: 16),
                    Row(
                      children: [
                        Expanded(
                          child: DropdownButtonFormField<String>(
                            decoration: const InputDecoration(
                              labelText: 'Negara*',
                              border: OutlineInputBorder(),
                            ),
                            value: _selectedCountry,
                            icon: const Icon(Icons.arrow_drop_down),
                            items: countries.map((String country) {
                              return DropdownMenuItem<String>(
                                value: country,
                                child: Text(country),
                              );
                            }).toList(),
                            onChanged: (String? newValue) {
                              setState(() {
                                _selectedCountry = newValue;
                                _validateForm();
                              });
                            },
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Negara wajib dipilih';
                              }
                              return null;
                            },
                          ),
                        ),
                        const SizedBox(width: 16),
                        Expanded(
                          child: DropdownButtonFormField<String>(
                            decoration: const InputDecoration(
                              labelText: 'Kota*',
                              border: OutlineInputBorder(),
                            ),
                            value: _selectedCity,
                            icon: const Icon(Icons.arrow_drop_down),
                            items: cities.map((String city) {
                              return DropdownMenuItem<String>(
                                value: city,
                                child: Text(city),
                              );
                            }).toList(),
                            onChanged: (String? newValue) {
                              setState(() {
                                _selectedCity = newValue;
                                _validateForm();
                              });
                            },
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Kota wajib dipilih';
                              }
                              return null;
                            },
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 16),
                    TextFormField(
                      controller: _startDateController,
                      decoration: const InputDecoration(
                        labelText: 'Tanggal Mulai*',
                        border: OutlineInputBorder(),
                        suffixIcon: Icon(Icons.calendar_today),
                      ),
                      readOnly: true,
                      onTap: () => _selectDate(context, _startDateController),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Tanggal mulai wajib diisi';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 16),
                    TextFormField(
                      controller: _endDateController,
                      decoration: const InputDecoration(
                        labelText: 'Tanggal Berakhir (atau ekspetasi)',
                        border: OutlineInputBorder(),
                        suffixIcon: Icon(Icons.calendar_today),
                      ),
                      readOnly: true,
                      enabled: !_stillWorkingHere,
                      onTap: () => _selectDate(context, _endDateController),
                      validator: (value) {
                        if (!_stillWorkingHere &&
                            (value == null || value.isEmpty)) {
                          return 'Tanggal berakhir wajib diisi jika tidak bekerja saat ini';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 8),
                    Row(
                      children: [
                        Checkbox(
                          value: _stillWorkingHere,
                          onChanged: (bool? value) {
                            setState(() {
                              _stillWorkingHere = value ?? false;
                              if (_stillWorkingHere) {
                                _endDateController.clear();
                              }
                              _validateForm();
                            });
                          },
                        ),
                        const Text('Saya masih bekerja di sini'),
                      ],
                    ),
                    const SizedBox(height: 16),
                    DropdownButtonFormField<String>(
                      decoration: const InputDecoration(
                        labelText: 'Fungsi Pekerjaan*',
                        border: OutlineInputBorder(),
                      ),
                      value: _selectedJobFunction,
                      icon: const Icon(Icons.arrow_drop_down),
                      items: jobFunctions.map((String function) {
                        return DropdownMenuItem<String>(
                          value: function,
                          child: Text(function),
                        );
                      }).toList(),
                      onChanged: (String? newValue) {
                        setState(() {
                          _selectedJobFunction = newValue;
                          _validateForm();
                        });
                      },
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Fungsi pekerjaan wajib dipilih';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 16),
                    DropdownButtonFormField<String>(
                      decoration: const InputDecoration(
                        labelText: 'Industri Perusahaan*',
                        border: OutlineInputBorder(),
                      ),
                      value: _selectedIndustry,
                      icon: const Icon(Icons.arrow_drop_down),
                      items: industries.map((String industry) {
                        return DropdownMenuItem<String>(
                          value: industry,
                          child: Text(industry),
                        );
                      }).toList(),
                      onChanged: (String? newValue) {
                        setState(() {
                          _selectedIndustry = newValue;
                          _validateForm();
                        });
                      },
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Industri perusahaan wajib dipilih';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 16),
                    Row(
                      children: [
                        Expanded(
                          child: DropdownButtonFormField<String>(
                            decoration: const InputDecoration(
                              labelText: 'Level Pekerjaan*',
                              border: OutlineInputBorder(),
                            ),
                            value: _selectedJobLevel,
                            icon: const Icon(Icons.arrow_drop_down),
                            items: jobLevels.map((String level) {
                              return DropdownMenuItem<String>(
                                value: level,
                                child: Text(level),
                              );
                            }).toList(),
                            onChanged: (String? newValue) {
                              setState(() {
                                _selectedJobLevel = newValue;
                                _validateForm();
                              });
                            },
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Level pekerjaan wajib dipilih';
                              }
                              return null;
                            },
                          ),
                        ),
                        const SizedBox(width: 16),
                        Expanded(
                          child: DropdownButtonFormField<String>(
                            decoration: const InputDecoration(
                              labelText: 'Tipe Pekerjaan*',
                              border: OutlineInputBorder(),
                            ),
                            value: _selectedJobType,
                            icon: const Icon(Icons.arrow_drop_down),
                            items: jobTypes.map((String type) {
                              return DropdownMenuItem<String>(
                                value: type,
                                child: Text(type),
                              );
                            }).toList(),
                            onChanged: (String? newValue) {
                              setState(() {
                                _selectedJobType = newValue;
                                _validateForm();
                              });
                            },
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Tipe pekerjaan wajib dipilih';
                              }
                              return null;
                            },
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 16),
                    const Text(
                      'Deskripsi Pekerjaan*',
                      style: TextStyle(
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    const SizedBox(height: 8),
                    TextFormField(
                      controller: _descriptionController,
                      decoration: const InputDecoration(
                        hintText:
                            'Tulis tugas dan tanggung jawab atau pencapaianmu selama bekerja di sini',
                        border: OutlineInputBorder(),
                      ),
                      maxLines: 5,
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Deskripsi pekerjaan wajib diisi';
                        }
                        return null;
                      },
                      onChanged: (value) => _validateForm(),
                    ),
                    const SizedBox(height: 24),
                    Row(
                      children: [
                        Expanded(
                          child: OutlinedButton(
                            onPressed: _isLoading ? null : () => Navigator.pop(context),
                            style: OutlinedButton.styleFrom(
                              side: const BorderSide(color: Colors.purple),
                              padding: const EdgeInsets.symmetric(vertical: 16),
                            ),
                            child: const Text(
                              'Batal',
                              style: TextStyle(color: Colors.purple),
                            ),
                          ),
                        ),
                        const SizedBox(width: 16),
                        Expanded(
                          child: ElevatedButton(
                            onPressed: (_isLoading || !isFormValid) ? null : _saveWorkExperience,
                            style: ElevatedButton.styleFrom(
                              backgroundColor: isFormValid
                                  ? const Color(0xFF9E61EB)
                                  : Colors.grey[300],
                              padding: const EdgeInsets.symmetric(vertical: 16),
                            ),
                            child: _isLoading
                                ? const SizedBox(
                                    width: 20,
                                    height: 20,
                                    child: CircularProgressIndicator(
                                      strokeWidth: 2,
                                      color: Colors.white,
                                    ),
                                  )
                                : Text(
                                    'Simpan',
                                    style: TextStyle(
                                        color: isFormValid ? Colors.white : Colors.black),
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
          // Overlay loading
          if (_isLoading)
            Container(
              color: Colors.black.withOpacity(0.3),
              child: const Center(
                child: CircularProgressIndicator(),
              ),
            ),
        ],
      ),
    );
  }
}