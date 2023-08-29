import 'package:flutter/material.dart';
import 'package:iconify_flutter/iconify_flutter.dart';
import 'package:iconify_flutter/icons/ep.dart';
import 'package:iconify_flutter/icons/heroicons.dart';
import 'package:iconify_flutter/icons/ic.dart';
import 'package:iconify_flutter/icons/material_symbols.dart';
import 'package:iconify_flutter/icons/mdi.dart';
import 'package:lanal_akses_mobile/Pages/PerizinanSuccessScreen.dart';
import 'package:lanal_akses_mobile/Widgets/customForm.dart';
import '../Themes/Theme.dart';
import '../Themes/Typography.dart';

class PerizinanPage extends StatefulWidget {
  const PerizinanPage({super.key});

  @override
  State<PerizinanPage> createState() => _PerizinanPageState();
}

class _PerizinanPageState extends State<PerizinanPage> {
  final _formAbsensiKey = GlobalKey<FormState>();
  final _dropdownKey = GlobalKey<FormState>();
  TextEditingController _namaPersonilCont = TextEditingController();
  TextEditingController _nrpPersonilCont = TextEditingController();

  var _statusKehadiran = 'Sakit';

  // List of items in our dropdown menu
  var dropdownItems = [
    'Sakit',
    'Dinas Luar Kota',
    'Panggilan Tugas',
    'Pendidikan',
    'Izin acara',
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBarAbsensiManual(context),
      backgroundColor: Color(0xffE5FFFF),
      body: Container(
        width: double.infinity,
        height: MediaQuery.of(context).size.height,
        padding: EdgeInsets.symmetric(horizontal: 20.0),
        child: ListView(
          children: [
            SizedBox(
              height: MediaQuery.of(context).size.height * 0.1,
            ),
            Text(
              'Perizinan Personil',
              style: mainTitle.copyWith(fontSize: 26),
              textAlign: TextAlign.left,
            ),
            SizedBox(
              height: 14,
            ),
            Text(
              'isi form perizinan sesuai dengan sebenar-benarnya',
              style: mainBody,
              textAlign: TextAlign.left,
            ),
            SizedBox(
              height: 36,
            ),
            Form(
              key: _formAbsensiKey,
              child: Column(
                children: [
                  customForm(
                    context,
                    TextInputType.text,
                    _namaPersonilCont,
                    'nama lengkap',
                    true,
                    Iconify(
                      Ic.baseline_person,
                      size: 28,
                      color: Colors.white,
                    ),
                  ),
                  SizedBox(
                    height: 14.0,
                  ),
                  customForm(
                    context,
                    TextInputType.text,
                    _nrpPersonilCont,
                    'nrp',
                    true,
                    Iconify(
                      Heroicons.identification_solid,
                      size: 28,
                      color: Colors.white,
                    ),
                  ),
                  SizedBox(
                    height: 14.0,
                  ),
                  Container(
                    width: MediaQuery.of(context).size.width,
                    child: Row(
                      children: [
                        Container(
                            decoration: BoxDecoration(
                              color: mainTheme.primaryColor,
                              borderRadius: BorderRadius.only(
                                topLeft: Radius.circular(16.0),
                                bottomLeft: Radius.circular(16.0),
                              ),
                              boxShadow: [
                                BoxShadow(
                                  blurRadius: 5,
                                  color: Colors.grey.shade400,
                                  offset: Offset(-2, 4),
                                )
                              ],
                            ),
                            padding: EdgeInsets.symmetric(
                                horizontal: 18, vertical: 16),
                            child: Iconify(
                              Mdi.clock,
                              color: Colors.white,
                            )),
                        Container(
                          padding: EdgeInsets.only(
                              right: 14, left: 6, top: 6, bottom: 6),
                          width: MediaQuery.of(context).size.width * 0.75,
                          decoration: BoxDecoration(
                            color: Colors.white,
                            borderRadius: BorderRadius.only(
                              topRight: Radius.circular(16.0),
                              bottomRight: Radius.circular(16.0),
                            ),
                            boxShadow: [
                              BoxShadow(
                                blurRadius: 5,
                                color: Colors.grey.shade400,
                                offset: Offset(2, 4),
                              )
                            ],
                          ),
                          child: DropdownButton(
                            isExpanded: true,
                            value: _statusKehadiran,
                            alignment: AlignmentDirectional.centerStart,
                            elevation: 18,
                            style: mainBody.copyWith(
                              fontSize: 18,
                            ),
                            icon: Icon(
                              Icons.keyboard_arrow_down,
                              color: Colors.grey[400],
                            ),
                            items: dropdownItems.map((String items) {
                              return DropdownMenuItem(
                                value: items,
                                child: Text(items),
                              );
                            }).toList(),
                            // After selecting the desired option,it will
                            // change button value to selected value
                            onChanged: (String? newValue) {
                              setState(() {
                                _statusKehadiran = newValue!;
                              });
                            },
                          ),
                        ),
                      ],
                    ),
                  ),
                  SizedBox(
                    height: 14.0,
                  ),
                  Container(
                    padding: EdgeInsets.all(6),
                    alignment: Alignment.centerLeft,
                    child: Text(
                      'wajib diisi',
                      style: mainsubHead.copyWith(
                          color: mainTheme.primaryColor, fontSize: 14),
                    ),
                  ),
                  SizedBox(
                    height: 14.0,
                  ),
                  ListTile(
                    contentPadding: EdgeInsets.only(right: 16),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12.0),
                    ),
                    onTap: () {},
                    tileColor: Colors.white,
                    leading: Container(
                        decoration: BoxDecoration(
                          color: mainTheme.primaryColor,
                          borderRadius: BorderRadius.only(
                            topLeft: Radius.circular(16.0),
                            bottomLeft: Radius.circular(16.0),
                          ),
                          boxShadow: [
                            BoxShadow(
                              blurRadius: 5,
                              color: Colors.grey.shade400,
                              offset: Offset(-2, 4),
                            )
                          ],
                        ),
                        padding:
                            EdgeInsets.symmetric(horizontal: 18, vertical: 16),
                        child: Iconify(
                          Mdi.file_document,
                          color: Colors.white,
                        )),
                    title: Text(
                      'Lampirkan Dokumen Bukti',
                      style: mainBody.copyWith(
                        color: Colors.grey[400],
                        fontSize: 18,
                      ),
                    ),
                    trailing: Iconify(
                      MaterialSymbols.cloud_upload,
                      color: mainTheme.primaryColor,
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.only(top: 30),
                    height: 55,
                    child: ElevatedButton(
                      onPressed: () {
                        var postData = [];
                        if (_formAbsensiKey.currentState!.validate()) {
                          setState(() {
                            postData.add(_namaPersonilCont.text);
                            postData.add(_nrpPersonilCont.text);
                          });
                          for (var data in postData) {
                            print(data);
                          }
                        }
                        showModalBottomSheet(
                            isScrollControlled: true,
                            context: context,
                            builder: (context) => PerizinanSuccess());
                      },
                      style: ButtonStyle(
                          shape:
                              MaterialStateProperty.all<RoundedRectangleBorder>(
                                  RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12.0),
                      ))),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Text(
                            'Kirim',
                            style: mainButtonText.copyWith(fontSize: 18.0),
                          ),
                          SizedBox(
                            width: 10,
                          ),
                          Iconify(
                            MaterialSymbols.send,
                            color: Colors.white,
                          )
                        ],
                      ),
                    ),
                  ),
                ],
              ),
            ),
            SizedBox(
              height: MediaQuery.of(context).size.height * 0.1,
            ),
          ],
        ),
      ),
    );
  }
}

PreferredSizeWidget AppBarAbsensiManual(BuildContext context) {
  return AppBar(
    title: Text(
      'Halaman Perizinan',
      style: mainTitle.copyWith(
        color: Colors.white,
        fontSize: 20.0,
      ),
      textAlign: TextAlign.right,
    ),
    leading: IconButton(
      onPressed: () {
        Navigator.pop(context);
      },
      icon: Iconify(
        Ep.arrow_left,
        size: 18.0,
        color: Colors.white,
      ),
    ),
  );
}
