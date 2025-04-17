import 'package:flutter_test/flutter_test.dart';
import 'package:flutter/material.dart';
import 'package:proyek_pa2/screens/job_posting_page.dart';

void main() {
  testWidgets('Test pemberian pekerjaan oleh pemberi kerja', (WidgetTester tester) async {
    // Memuat halaman
    await tester.pumpWidget(MaterialApp(home: JobPostingPage()));
    await tester.pumpAndSettle(); // ✅ Tunggu hingga UI siap

    // Temukan elemen input
    final Finder titleField = find.byKey(Key('titleField'));
    final Finder descField = find.byKey(Key('descField'));
    final Finder categoryDropdown = find.byKey(Key('categoryDropdown'));
    final Finder budgetField = find.byKey(Key('budgetField'));
    final Finder deadlineField = find.byKey(Key('deadlineField'));
    final Finder postButton = find.byKey(Key('postButton'));

    // ✅ Pastikan elemen ditemukan sebelum mengisi teks
    expect(titleField, findsOneWidget);
    expect(descField, findsOneWidget);
    expect(categoryDropdown, findsOneWidget);
    expect(budgetField, findsOneWidget);
    expect(deadlineField, findsOneWidget);
    expect(postButton, findsOneWidget);

    // Isi form
    await tester.enterText(titleField, 'Mengecat Rumah');
    await tester.enterText(descField, 'Mencari tenaga pengecatan untuk renovasi');

    // Pilih kategori (dropdown sudah memiliki default)
    await tester.tap(categoryDropdown);
    await tester.pumpAndSettle(); // ✅ Tunggu opsi muncul
    await tester.tap(find.text('Perbaikan Rumah').last);
    await tester.pumpAndSettle(); // ✅ Tunggu animasi selesai

    await tester.enterText(budgetField, '500000');
    await tester.enterText(deadlineField, '2024-05-01');
    await tester.pumpAndSettle(); // ✅ Pastikan UI telah diperbarui

    // Klik tombol submit
    await tester.tap(postButton);
    await tester.pumpAndSettle(); // ✅ Tunggu SnackBar muncul

    // Verifikasi pekerjaan berhasil ditambahkan
    expect(find.text('Pekerjaan berhasil ditambahkan!'), findsOneWidget);
  });
}
