// ignore: file_names
import 'package:flutter/material.dart';

var mainTheme = ThemeData(
  primaryColorLight: const Color(0xFF385655),
  backgroundColor: const Color(0xFF4E6766),
  primarySwatch: createMaterialColor(const Color(0xFF385655)),
  colorScheme: const ColorScheme(
    brightness: Brightness.light,
    primary: Color(0xFF385655),
    onPrimary: Color(0xFF263238),
    secondary: Color(0xFF7EBFFF),
    onSecondary: Color.fromARGB(255, 68, 138, 208),
    error: Color.fromARGB(255, 219, 63, 115),
    onError: Color.fromARGB(255, 219, 63, 115),
    background: Color(0xFFD9D9D9),
    onBackground: Color(0xFFD9D9D9),
    surface: Color(0xFFD9D9D9),
    onSurface: Color(0xFFD9D9D9),
  ),
);

// ==== Func untk membuat Custom MaterialColor =====
MaterialColor createMaterialColor(Color color) {
  List strengths = <double>[.05];
  Map<int, Color> swatch = {};
  final int r = color.red, g = color.green, b = color.blue;

  for (int i = 1; i < 10; i++) {
    strengths.add(0.1 * i);
  }
  for (var strength in strengths) {
    final double ds = 0.5 - strength;
    swatch[(strength * 1000).round()] = Color.fromRGBO(
      r + ((ds < 0 ? r : (255 - r)) * ds).round(),
      g + ((ds < 0 ? g : (255 - g)) * ds).round(),
      b + ((ds < 0 ? b : (255 - b)) * ds).round(),
      1,
    );
  }
  return MaterialColor(color.value, swatch);
}
