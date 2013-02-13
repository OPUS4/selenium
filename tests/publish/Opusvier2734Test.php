<?php
/**
 * This file is part of OPUS. The software OPUS has been originally developed
 * at the University of Stuttgart with funding from the German Research Net,
 * the Federal Department of Higher Education and Research and the Ministry
 * of Science, Research and the Arts of the State of Baden-Wuerttemberg.
 *
 * OPUS 4 is a complete rewrite of the original OPUS software and was developed
 * by the Stuttgart University Library, the Library Service Center
 * Baden-Wuerttemberg, the Cooperative Library Network Berlin-Brandenburg,
 * the Saarland University and State Library, the Saxon State Library -
 * Dresden State and University Library, the Bielefeld University Library and
 * the University Library of Hamburg University of Technology with funding from
 * the German Research Foundation and the European Regional Development Fund.
 *
 * LICENCE
 * OPUS is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the Licence, or any later version.
 * OPUS is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details. You should have received a copy of the GNU General Public License
 * along with OPUS; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 *
 * @category    TODO
 * @package     TODO
 * @author      Sascha Szott <szott@zib.de>
 * @copyright   Copyright (c) 2008-2013, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 * @version     $Id$
 */

require_once 'TestCasePublish.php';

class Opusvier2734Test extends TestCasePublish {

    public function testAddAndDeleteButton() {
        $this->goToSecondStepForDoctypeAll();
        
        $this->assertElementPresent('PersonAuthorFirstName_1');
        $this->type('PersonAuthorFirstName_1', 'PAFN1');
        $this->type('PersonAuthorLastName_1', 'PALN1');

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->goBackToSecondStep();
        
        $this->click('addMorePersonAuthor');
        $this->waitForPageToLoad();
        $this->assertElementPresent('PersonAuthorFirstName_1');
        $this->assertElementPresent('PersonAuthorFirstName_2');
        $this->type('PersonAuthorFirstName_2', 'PAFN2');
        $this->type('PersonAuthorLastName_2', 'PALN2');

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->assertTextPresent('PAFN2');
        $this->assertTextPresent('PALN2');
        $this->goBackToSecondStep();

        $this->click('addMorePersonAuthor');
        $this->waitForPageToLoad();
        $this->assertElementPresent('PersonAuthorFirstName_1');
        $this->assertElementPresent('PersonAuthorFirstName_2');
        $this->assertElementPresent('PersonAuthorFirstName_3');
        $this->type('PersonAuthorFirstName_3', 'PAFN3');
        $this->type('PersonAuthorLastName_3', 'PALN3');

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->assertTextPresent('PAFN2');
        $this->assertTextPresent('PALN2');
        $this->assertTextPresent('PAFN3');
        $this->assertTextPresent('PALN3');
        $this->goBackToSecondStep();

        $this->click('deleteMorePersonAuthor');
        $this->waitForPageToLoad();
        $this->assertElementPresent('PersonAuthorFirstName_1');
        $this->assertElementPresent('PersonAuthorFirstName_2');
        $this->assertElementNotPresent('PersonAuthorFirstName_3');

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->assertTextPresent('PAFN2');
        $this->assertTextPresent('PALN2');
        $this->assertTextNotPresent('PAFN3');
        $this->assertTextNotPresent('PALN3');
        $this->goBackToSecondStep();

        $this->click('deleteMorePersonAuthor');
        $this->waitForPageToLoad();
        $this->assertElementPresent('PersonAuthorFirstName_1');
        $this->assertElementNotPresent('PersonAuthorFirstName_2');
        $this->assertElementNotPresent('PersonAuthorFirstName_3');

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->assertTextNotPresent('PAFN2');
        $this->assertTextNotPresent('PALN2');
        $this->assertTextNotPresent('PAFN3');
        $this->assertTextNotPresent('PALN3');
        $this->goBackToSecondStep();
        
        $this->click('addMorePersonAuthor');
        $this->waitForPageToLoad();
        $this->assertElementPresent('PersonAuthorFirstName_1');
        $this->assertElementPresent('PersonAuthorFirstName_2');
        $this->assertElementNotPresent('PersonAuthorFirstName_3');
        $this->type('PersonAuthorFirstName_2', 'PAFN4');
        $this->type('PersonAuthorLastName_2', 'PALN4');

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->assertTextNotPresent('PAFN2');
        $this->assertTextNotPresent('PALN2');
        $this->assertTextNotPresent('PAFN3');
        $this->assertTextNotPresent('PALN3');
        $this->assertTextPresent('PAFN4');
        $this->assertTextPresent('PALN4');
        $this->goBackToSecondStep();

        $this->click('deleteMorePersonAuthor');
        $this->waitForPageToLoad();
        $this->assertTrue($this->isElementPresent('PersonAuthorFirstName_1'));
        $this->assertFalse($this->isElementPresent('PersonAuthorFirstName_2'));
        $this->assertFalse($this->isElementPresent('PersonAuthorFirstName_3'));

        $this->goToThirdStep();
        $this->assertTextPresent('PAFN1');
        $this->assertTextPresent('PALN1');
        $this->assertTextNotPresent('PAFN2');
        $this->assertTextNotPresent('PALN2');
        $this->assertTextNotPresent('PAFN3');
        $this->assertTextNotPresent('PALN3');
        $this->assertTextNotPresent('PAFN4');
        $this->assertTextNotPresent('PALN4');
        $this->goBackToSecondStep();

        $this->click('abort');
    }

    public function testBrowseUpAndDownButton() {
        $this->goToSecondStepForDoctypeAll();

        $this->select('SubjectMSC_1', 'value=7653');                

        $this->goToThirdStep();
        $this->assertTextPresent('00-XX GENERAL');
        $this->goBackToSecondStep();

        $this->assertSelectedValue('SubjectMSC_1', '7653');
        
        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();
        $this->assertElementValueEquals('//select[@id="SubjectMSC_1"]/@disabled', "1");

        $this->goToThirdStep();
        $this->assertTextPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->assertSelectedValue('SubjectMSC_1', '7653');
        $this->assertSelectedValue('collId2SubjectMSC_1', '7654');

        $this->select('collId2SubjectMSC_1', 'value=7655');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->goBackToSecondStep();

        $this->assertSelectedValue('SubjectMSC_1', '7653');
        $this->assertSelectedValue('collId2SubjectMSC_1', '7655');
        
        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertElementValueEquals('//select[@id="SubjectMSC_1"]/@disabled', "1");
        $this->assertElementValueEquals('//select[@id="collId2SubjectMSC_1"]/@disabled', "1");

        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->goBackToSecondStep();

        $this->assertSelectedValue('SubjectMSC_1', '7653');
        $this->assertSelectedValue('collId2SubjectMSC_1', '7655');
        
        $this->click('addMoreSubjectMSC');
        $this->waitForPageToLoad();
        
        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->goBackToSecondStep();

        $this->assertSelectedValue('SubjectMSC_1', '7653');
        $this->assertSelectedValue('collId2SubjectMSC_1', '7655');
        $this->assertSelectedValue('SubjectMSC_2', '');

        
        $this->select('SubjectMSC_2', 'value=7871');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->goBackToSecondStep();

        $this->assertSelectedValue('SubjectMSC_1', '7653');
        $this->assertSelectedValue('collId2SubjectMSC_1', '7655');
        $this->assertSelectedValue('SubjectMSC_2', '7871');
        
        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertElementValueEquals('//select[@id="SubjectMSC_2"]/@disabled', "1");
        
        $this->select('collId2SubjectMSC_2', 'value=7873');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();
      
        $this->assertSelectedValue('SubjectMSC_1', '7653');
        $this->assertSelectedValue('collId2SubjectMSC_1', '7655');
        $this->assertSelectedValue('SubjectMSC_2', '7871');
        $this->assertSelectedValue('collId2SubjectMSC_2', '7873');
        
        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertElementValueEquals('//select[@id="SubjectMSC_2"]/@disabled', "1");
        $this->assertElementValueEquals('//select[@id="collId2SubjectMSC_2"]/@disabled', "1");
        
        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->assertSelectedValue('SubjectMSC_1', '7653');
        $this->assertSelectedValue('collId2SubjectMSC_1', '7655');
        $this->assertSelectedValue('SubjectMSC_2', '7871');
        $this->assertSelectedValue('collId2SubjectMSC_2', '7873');
        
        $this->click('addMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->click('addMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertElementValueEquals('//select[@id="SubjectMSC_3"]/@disabled', "1");

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->select('SubjectMSC_4', 'value=7871');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->click('addMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertElementPresent('//div[contains(@class, "odd")]/div/select[@id="SubjectMSC_5"]');
        
        $this->assertElementValueEquals('//select[@id="SubjectMSC_4"]/@disabled', "1");

        
        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->select('SubjectMSC_5', 'value=7727');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('03-XX MATHEMATICAL LOGIC AND FOUNDATIONS');
        $this->goBackToSecondStep();

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertElementValueEquals('//select[@id="SubjectMSC_5"]/@disabled', "1");
       
        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('03-XX MATHEMATICAL LOGIC AND FOUNDATIONS');
        $this->assertTextPresent('03-00 General reference works (handbooks, dictionaries, bibliographies, etc.)');
        $this->goBackToSecondStep();

        $this->click('deleteMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('03-XX MATHEMATICAL LOGIC AND FOUNDATIONS');
        $this->assertTextNotPresent('03-00 General reference works (handbooks, dictionaries, bibliographies, etc.)');
        $this->goBackToSecondStep();

        $this->click('deleteMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertElementPresent('//select[@id="SubjectMSC_3"]');
        $this->assertElementNotPresent('//select[@id="SubjectMSC_3"][@disabled="1"]');
        
        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('03-XX MATHEMATICAL LOGIC AND FOUNDATIONS');
        $this->assertTextNotPresent('03-00 General reference works (handbooks, dictionaries, bibliographies, etc.)');
        $this->goBackToSecondStep();

        $this->click('deleteMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('03-XX MATHEMATICAL LOGIC AND FOUNDATIONS');
        $this->assertTextNotPresent('03-00 General reference works (handbooks, dictionaries, bibliographies, etc.)');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertElementPresent('//select[@id="collId2SubjectMSC_2"]');
        $this->assertElementNotPresent('//select[@id="collId2SubjectMSC_2"][@disabled="1"]');
        $this->assertElementValueEquals('//select[@id="SubjectMSC_2"]/@disabled', "1");

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('03-XX MATHEMATICAL LOGIC AND FOUNDATIONS');
        $this->assertTextNotPresent('03-00 General reference works (handbooks, dictionaries, bibliographies, etc.)');
        $this->goBackToSecondStep();

        $this->select('collId2SubjectMSC_2', 'value=7878');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->goBackToSecondStep();

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();
        
        $this->select('collId3SubjectMSC_2', 'value=7880');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();        

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->select('SubjectMSC_2', 'label=Bitte wählen Sie eine MSC Klasse');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('deleteMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->select('SubjectMSC_1', 'label=Bitte wählen Sie eine MSC Klasse');

        $this->goToThirdStep();
        $this->assertTextNotPresent('00-XX GENERAL');
        $this->assertTextNotPresent('00-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('00-02 Research exposition (monographs, survey articles)');
        $this->assertTextNotPresent('05-XX COMBINATORICS (For finite fields, see 11Txx)');
        $this->assertTextNotPresent('05-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('05Axx Enumerative combinatorics For enumeration in graph theory, see 05C30');
        $this->assertTextNotPresent('05A10 Factorials, binomial coefficients, combinatorial functions [See also 11B65, 33Cxx]');
        $this->goBackToSecondStep();

        $this->click('abort');
    }

    public function testMSCSelectionIfRequired() {
        $this->goToSecondStepForDoctypeMatheon();

        $this->type('PersonAuthorFirstName_1', 'PAFN1');
        $this->type('PersonAuthorLastName_1', 'PALN1');
        $this->type('TitleMain_1', 'TM1');
        $this->type('TitleAbstract_1', 'TA1');

        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');

        $this->click('browseDownInstitute');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');
        
        $this->select('Institute_1', 'value=15994');

        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');

        $this->click('addMoreInstitute');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');

        $this->click('deleteMoreInstitute');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');

        $this->click('browseDownInstitute');
        $this->waitForPageToLoad();

        $this->select('collId2Institute_1', 'value=15999');

        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');

        $this->click('browseDownInstitute');
        $this->waitForPageToLoad();

        $this->select('collId3Institute_1', 'value=16031');

        $this->click('browseDownInstitute');
        $this->waitForPageToLoad();

        $this->assertTextPresent('Sie haben das Ende dieser Sammlung erreicht.');

        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');

        $this->select('SubjectMSC_1', 'value=7727');
        
        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();
        
        $this->select('collId2SubjectMSC_1', 'value=7729');

        $this->goToThirdStep();
        $this->assertTextPresent('Zuverlässigkeitstechnik M-24');
        $this->assertTextPresent('03-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('Zuverlässigkeitstechnik M-24');
        $this->assertTextPresent('03-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('Zuverlässigkeitstechnik M-24');
        $this->assertTextPresent('03-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->click('addMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');

        $this->select('SubjectMSC_2', 'value=7957');

        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->select('collId2SubjectMSC_2', 'value=7959');

        $this->goToThirdStep();
        $this->assertTextPresent('Zuverlässigkeitstechnik M-24');
        $this->assertTextPresent('03-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('06-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->click('deleteMoreSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('Zuverlässigkeitstechnik M-24');
        $this->assertTextPresent('03-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('06-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->goBackToSecondStep();

        $this->click('browseUpSubjectMSC');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');

        $this->click('browseDownSubjectMSC');
        $this->waitForPageToLoad();

        $this->select('collId2SubjectMSC_1', 'value=7731');

        $this->goToThirdStep();
        $this->assertTextPresent('Zuverlässigkeitstechnik M-24');
        $this->assertTextNotPresent('03-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('06-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('03-03 Historical (must also be assigned at least one classification number from Section 01)');
        $this->goBackToSecondStep();

        $this->click('browseUpInstitute');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('Zuverlässigkeitstechnik M-24');
        $this->assertTextNotPresent('03-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('06-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('03-03 Historical (must also be assigned at least one classification number from Section 01)');
        $this->goBackToSecondStep();

        $this->click('browseUpInstitute');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');

        $this->click('browseDownInstitute');
        $this->waitForPageToLoad();

        $this->select('collId3Institute_1', 'value=16065');
        
        $this->goToThirdStep();
        $this->assertTextNotPresent('Zuverlässigkeitstechnik M-24');
        $this->assertTextNotPresent('03-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextNotPresent('06-01 Instructional exposition (textbooks, tutorial papers, etc.)');
        $this->assertTextPresent('03-03 Historical (must also be assigned at least one classification number from Section 01)');
        $this->assertTextPresent('Metallkunde und Werkstofftechnik M-15');
        $this->goBackToSecondStep();

        $this->click('addMoreInstitute');
        $this->waitForPageToLoad();

        $this->goToThirdStep();
        $this->assertTextPresent('Es sind Fehler aufgetreten. Bitte beachten Sie die Fehlermeldungen an den Formularfeldern.');

        $this->click('abort');
    }

}

?>
