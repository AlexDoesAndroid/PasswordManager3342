<%@ Page Title="" Language="C#" MasterPageFile="~/passwordManager.Master" AutoEventWireup="true" CodeBehind="myPasswords.aspx.cs" Inherits="PasswordManager3342.myPasswords" %>
<asp:Content ID="Content1" ContentPlaceHolderID="head" runat="server">
</asp:Content>

<asp:Content ID="Content2" ContentPlaceHolderID="ContentPlaceHolder1" runat="server">
     <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
     </script>
    
    <div style="height:50px; width:100%; margin-top:10px;">
        <div style="height:25px; width:60%; background-color:black; border-radius: 25px; margin-left: 20%; text-align:center; color:white;">
            My Passwords
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Website URL </th>
                <th>Password</th>
                <th>Catagory</th>
                <th>Last Modified</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Netflix</td>
                <td>notarealEmail@hotmail.com</td>
                <td>https://www.netflix.com/</td>
                <td>%7}[7!`6Gj#T7u}p</td>
                <td>Streaming</td>
                <td>4/17/2022</td>
                <td colspan="6">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                        Edit Password
                    </button>
                </td>
            </tr>            
            
            <tr>
                <td>Netflix</td>
                <td>ArealEmail@hotmail.com</td>
                <td>https://www.netflix.com/</td>
                <td>%7}[7!Dog</td>
                <td>Streaming</td>
                <td>3/27/2019</td>
                <td colspan="6">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                        Edit Password
                    </button>
                </td>
            </tr>
            
            <tr>
                <td>Amazon</td>
                <td>jeffBezos@gmail.com</td>
                <td>https://www.amazon.com/</td>
                <td>zmcatoz3bE</td>
                <td>Shopping</td>
                <td>12/02/2020</td>
                <td colspan="6">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                        Edit Password
                    </button>
                </td>
            </tr>
            
            <tr>
                <td>Gmail</td>
                <td>JohnDoe@aol.com</td>
                <td>https://login.aol.com/</td>
                <td>BadPassword1!</td>
                <td>email</td>
                <td>05/04/2021</td>
                <td colspan="6">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                        Edit Password
                    </button>
                </td>
            </tr>
            
            <tr>
                <td>Gmail</td>
                <td>JaneSmith@gmail.com</td>
                <td>https://mail.google.com/</td>
                <td>BadPassword2!</td>
                <td>email</td>
                <td>09/07/2021</td>
                <td colspan="6">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                        Edit Password
                    </button>
                </td>
            </tr>

        </tbody>
    </table>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body row g-3">
                    <div class="col-md-10">
                        <label for="validationPreviousPassword" class="form-label">Previous Password:</label>
                        <div class="input-group has-validation">
                            
                            <input type="text" class="form-control" id="validationPreviousPassword" aria-describedby="inputGroupPrepend" required="">
                            <div class="invalid-feedback">
                                Please input the old password.
                            </div>
                        </div>
                    </div>
                      <div class="col-md-10">
                        <label for="validationPreviousPassword" class="form-label">New Password:</label>
                        <div class="input-group has-validation">
                            
                            <input type="text" class="form-control" id="validationNewPassword" aria-describedby="inputGroupPrepend" required="">
                            <div class="invalid-feedback">
                                Please input the new password.
                            </div>
                        </div>
                    </div>

                <div class="col-md-5">
                    <label for="validationName" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="validationName" value="" required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="validationUserName" class="form-label">User Name:</label>
                    <input type="text" class="form-control" id="validationUserName" value="" required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>

           <div class="col-md-5">
                    <label for="validationURL" class="form-label">Website URL:</label>
                    <input type="text" class="form-control" id="validationURL" value="" required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="validationCatagory" class="form-label">Catagory:</label>
                    <input type="text" class="form-control" id="validationCatagory" value="" required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                

             <div class="col-12">
                 <br />
                    <button class="btn btn-secondary" type="submit">Save Changes</button>
             </div>
                </div>
            </div>
        </div>
    </div>
</asp:Content>
