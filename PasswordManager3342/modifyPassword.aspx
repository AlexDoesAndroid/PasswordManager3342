<%@ Page Title="" Language="C#" MasterPageFile="~/passwordManager.Master" AutoEventWireup="true" CodeBehind="modifyPassword.aspx.cs" Inherits="PasswordManager3342.modifyPassword" %>
<asp:Content ID="Content1" ContentPlaceHolderID="head" runat="server">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="ContentPlaceHolder1" runat="server">
    <div style="height:50px; width:100%; margin-top:20px;">
        <div style="height:25px; width:60%; background-color:#981E32; border-radius: 25px; margin-left: 20%; text-align:center; color:white;">
            Digital Equity Center - Modify Ticket
        </div>
    </div>

    <asp:Panel ID="pnlCreateTicket" class="mx-auto" margin="auto" width="90%" runat="server" BackColor="#999999" BorderStyle="Solid">
        <asp:Label ID="lblEmail" class="col-md-10"  runat="server" Text="Email">
            <asp:TextBox id="txtEmail" Width="42%" placeholder="johndoe@temple.edu" runat="server"> </asp:TextBox>
        </asp:Label>
        <asp:Label ID="lblPhone" class="col-md-10"  runat="server" Text="Phone">
            <asp:TextBox id="txtPhone" Width="42%" placeholder="267-306-9082" runat="server"> </asp:TextBox>
        </asp:Label>
        <br />
        <br />
        <asp:Label ID="lblFirstName" class="col-md-5" runat="server" Text="First Name">
            <asp:TextBox id="txtFirstname" Width="40%" placeholder="John" runat="server"> </asp:TextBox>
        </asp:Label>
        <asp:Label ID="lblLastName" class="col-md-5" runat="server" Text="Last Name">
            <asp:TextBox id="txtLastname" Width="40%" placeholder="Doe" runat="server"> </asp:TextBox>
        </asp:Label>
        <br />
        <br />
        <asp:Label ID="lblSubject" class="col-md-10" runat="server" Text="Subject">
            <asp:TextBox id="txtSubject" Width="42%" placeholder="Zoom not working" runat="server"> </asp:TextBox>   
        </asp:Label>
        <asp:Label ID="lblNotes" class="col-md-10" runat="server" Text="Additional Notes">
            <textarea id="taNotes" runat="server">   </textarea>
        </asp:Label>

        <br />
        <br />

        <asp:Panel runat="server" ID="ddlBoxes" Width="40%" align="right" style="display: inline-block">
            <asp:Label ID="lblPrimaryStatus" runat="server" Text="Primary Status">
            <asp:DropDownList ID="ddlPrimary" runat="server">
                <asp:ListItem>In-Progress</asp:ListItem>
                <asp:ListItem>Assigned</asp:ListItem>
                <asp:ListItem>New</asp:ListItem>
                <asp:ListItem>Pending</asp:ListItem>
                <asp:ListItem>Resolved</asp:ListItem>
                <asp:ListItem>Closed</asp:ListItem>
            </asp:DropDownList>
        </asp:Label>
        <br />
        <br />
        <asp:Label ID="lblSecondaryStatus" runat="server" Text="Secondary Status">
            <asp:DropDownList ID="ddlSecondary" runat="server">
                <asp:ListItem>Ongoing</asp:ListItem>
            </asp:DropDownList>
        </asp:Label>
        <br />
        <br />
        <asp:Label ID="lblPriority" runat="server" Text="Priority">
            <asp:DropDownList ID="ddlPriority" runat="server">
                <asp:ListItem>High</asp:ListItem>
                <asp:ListItem>Medium</asp:ListItem>
                <asp:ListItem>low</asp:ListItem>
            </asp:DropDownList>
        </asp:Label>
        <br />
        <br />
        <asp:Label ID="lblAssigned" runat="server" Text="Assigned">
            <asp:DropDownList ID="ddlAssigned" runat="server">
                <asp:ListItem>Sean M.</asp:ListItem>
                <asp:ListItem>Raehaan A.</asp:ListItem>
                <asp:ListItem>Alex M.</asp:ListItem>
            </asp:DropDownList>
        </asp:Label>
        </asp:Panel>
        <asp:Panel runat="server" Width="40%" style="float:right">
        <asp:Label ID="lblAttatchments" runat="server" Text="Attachments">
            <asp:Panel id="uploadDisplay" BackColor="#FFFFF" height="100px" width="90%" border="solid" runat="server">
                placehoder
            </asp:Panel>
            <asp:Button ID="btnSelect" class="btn btn-secondary" runat="server" text="Select Attachments"/>
            <asp:Button ID="btnUpload" class="btn btn-secondary" runat="server" text="Upload"/>
        </asp:Label>
         </asp:Panel>
        <br />
        <br />
        <asp:Panel runat="server" class="mx-auto" style="text-align:center" ID="pnlButton">
            <asp:Button ID="btnCreate" class="btn btn-danger " runat="server" text="Save Ticket"/>
        </asp:Panel>
        
    </asp:Panel>
</asp:Content>
