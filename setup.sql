CREATE TABLE patients
(
  PatientID INT NOT NULL,
  Gender CHAR(1) NOT NULL,
  Ethnicity VARCHAR(100) NOT NULL,
  PRIMARY KEY (PatientID)
);

CREATE TABLE users (
  Username VARCHAR(16) NULL,
  Email VARCHAR(255) NULL,
  Password VARCHAR(32) NULL,
  modified TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  created TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (Username));

CREATE TABLE gender_informations
(
  Inheritance_Pattern VARCHAR(25) NULL,
  Genetic_Diagnosis VARCHAR(40) NULL,
  FamilyID INT NULL,
  PatientID INT NULL,
  modified TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  created TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (FamilyID),
  FOREIGN KEY (PatientID) REFERENCES patients(PatientID)
);

CREATE TABLE family_members
(
  Relationship VARCHAR(40) NULL,
  MemberID INT NULL,
  PatientID INT NULL,
  FamilyID INT NULL,
  modified TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  created TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (MemberID),
  FOREIGN KEY (PatientID) REFERENCES patients(PatientID),
  FOREIGN KEY (FamilyID) REFERENCES gender_informations(FamilyID)
);

CREATE TABLE method_of_interpolations
(
  MethodID INT,
  Description VARCHAR(150),
  modified TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  created TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (MethodID)
);

CREATE TABLE audiograms
(
  Age INT NULL,
  Date_of_Collection DATE NULL,
  AudioPic VARCHAR(8000) NULL,
  AudiogramID INT NULL,
  PatientID INT NULL,
  MethodID INT NULL,
  modified TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  created TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (AudiogramID),
  FOREIGN KEY (PatientID) REFERENCES patients(PatientID),
  FOREIGN KEY (MethodID) REFERENCES method_of_interpolations(MethodID)
);

CREATE TABLE loss_hearings
(
  FrequencyID INT,
  Frequency FLOAT,
  dB_Loss FLOAT,
  Interpolated_Value INT,
  AudiogramID INT NULL,
  modified TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  created TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (FrequencyID),
  FOREIGN KEY (AudiogramID) REFERENCES audiograms(AudiogramID)
);

