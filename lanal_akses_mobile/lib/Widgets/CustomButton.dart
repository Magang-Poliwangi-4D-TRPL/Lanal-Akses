import 'dart:ffi';

import 'package:flutter/material.dart';
import 'package:lanal_akses_mobile/Themes/Theme.dart';
import 'package:lanal_akses_mobile/Themes/Typography.dart';

Widget customTextButton(String buttonText, Function()? onTap,
    {Color? buttonColor}) {
  return InkWell(
    onTap: onTap,
    child: Container(
      decoration: BoxDecoration(
        border: Border.all(color: mainTheme.colorScheme.onPrimary, width: 2.0),
        borderRadius: BorderRadius.circular(8.0),
        color:
            buttonColor != null ? buttonColor : mainTheme.colorScheme.onPrimary,
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Padding(
            padding:
                const EdgeInsets.symmetric(vertical: 8.0, horizontal: 14.0),
            child: Text(
              buttonText,
              style: mainButtonText,
              textAlign: TextAlign.center,
            ),
          )
        ],
      ),
    ),
  );
}
